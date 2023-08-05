<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Life;
use App\Models\Cell;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Comment;
use App\Models\Img;
use App\Models\Notification;

class LifeController extends Controller
{
    public function storeLifeAndCell(Request $request)
    {
        try {
            $request->validate([
                'life_name' => ['required', 'max:50'],
                'life_detail' => ['required', 'max:100'],
                'life_message' => ['required', 'max:50'],
                'img_id' => ['nullable', 'exists:imgs,img_id'],
                'release' => ['nullable', 'integer'],
                'cells' => ['required', 'array'],
                'cells.*.cell_detail' => ['nullable', 'max:100'],
                'cells.*.cell_no' => ['required', 'integer'],
                'cells.*.cell_point' => ['nullable', 'integer'],
                'cells.*.cell_color' => ['required', 'max:50'],
            ]);

            $token = $request->bearerToken();
            $user = User::where('token', $token)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            $life = null;

            DB::transaction(function () use ($request, &$life, $user) {
                $lifeData = Arr::except($request->all(), ['cells']);
                $lifeData['user_id'] = $user->user_id;
                $life = Life::create($lifeData);

                if ($user->life_id == null) {
                    $user->life_id = $life->life_id;
                    $user->save();
                }

                foreach ($request->cells as $cellData) {
                    $cellData['life_id'] = $life->life_id;
                    Cell::create($cellData);
                }
            });

            if ($life) {
                return response()->json([
                    'message' => 'successfully',
                    'life' => $life,
                    'cells' => Cell::where('life_id', $life->life_id)->get()
                ]);
            }
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateLifeAndCell(Request $request)
    {
        try {
            $request->validate([
                'life_id' => ['required', 'integer', 'exists:lifes,life_id'],
                'cells' => ['required', 'array'],
                'cells.*.cell_no' => ['required', 'integer'],
            ]);

            $token = $request->bearerToken();
            $user = User::where('token', $token)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            $life = Life::find($request->life_id);

            if ($life->user_id !== $user->user_id) {
                return response()->json([
                    'message' => 'このlife_idは認証されたユーザーのものではありません。'
                ], 403);
            }

            DB::transaction(function () use ($request, &$life) {
                $lifeData = Arr::except($request->all(), ['cells']);
                $life->update(array_filter($lifeData));

                $cells = Cell::where('life_id', $life->life_id)
                    ->orderBy('cell_no')
                    ->get();

                foreach ($request->cells as $index => $cellData) {
                    $cell = $cells[$index];
                    if ($cell->cell_no !== $cellData['cell_no']) {
                        throw new \Exception("無効な cell_no: Lifeに属していません");
                    }
                    $cell->update(array_filter($cellData));
                }
            });

            return response()->json([
                'message' => 'successfully',
                'life' => $life,
                'cells' => Cell::where('life_id', $life->life_id)->get()
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getLifeWithComments(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token', $token)->with('img')->first();

        $lifes = Life::where('user_id', $user->user_id)->with('img', 'comments', 'comments.user.img')->get();

        $result = [];
        $result['message'] = 'successfully';

        $img_path = $user->img ? $user->img->img_path : null;
        $result['user'] = [
            'user_id' => $user->user_id,
            'img_path' => $img_path,
            'user_mail' => $user->user_mail,
            'user_name' => $user->user_name,
            'life_id' => $user->life_id,
            'birth' => $user->birth,
            'blood_type' => $user->blood_type,
            'height' => $user->height,
            'hobby' => $user->hobby,
            'episode1' => $user->episode1,
            'episode2' => $user->episode2,
            'episode3' => $user->episode3,
            'episode4' => $user->episode4,
        ];

        foreach ($lifes as $life) {
            $life_img_path = $life->img ? $life->img->img_path : null;

            $lifeArray = [
                'life_id' => $life->life_id,
                'img_id' => $life->img_id,
                'img_path' => $life_img_path,
                'life_name' => $life->life_name,
                'life_detail' => $life->life_detail,
                'life_message' => $life->life_message,
                'user_id' => $life->user_id,
                'good' => $life->good,
                'release' => $life->release,
            ];

            $commentsArray = [];
            foreach ($life->comments as $comment) {
                $commentUser = $comment->user;
                $comment_img_path = $commentUser->img ? $commentUser->img->img_path : null;
                $commentsArray[] = [
                    'user_id' => $commentUser->user_id,
                    'user_name' => $commentUser->user_name,
                    'user_email' => $commentUser->user_mail,
                    'img_path' => $comment_img_path,
                    'comment' => $comment->comment
                ];
            }

            $lifeArray['comments'] = $commentsArray;
            $result['lifes'][] = $lifeArray;
        }

        return response()->json($result);
    }

    public function getOtherLifeWithComments(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('user_id', $user_id)->with('img')->first();

        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $result = [];
        $result['message'] = 'successfully';
        $result['user'] = $this->formatUser($user);

        $lifes = Life::where('user_id', $user_id)
            ->where('release', 1)
            ->with('img', 'comments', 'comments.user.img')
            ->get();

        foreach ($lifes as $life) {
            $result['lifes'][] = $this->formatLife($life);
        }

        return response()->json($result);
    }

    public function getLifeWithCells($life_id)
    {

        $life = Life::where('life_id', $life_id)->with('img')->first();

        if ($life == null) {
            return response()->json(['message' => 'Life not found']);
        }

        $result = [];
        $result['message'] = 'successfully';

        $life_img_path = $life->img ? $life->img->img_path : null;

        $lifeArray = [
            'life_id' => $life->life_id,
            'img_id' => $life->img_id,
            'img_path' => $life_img_path,
            'life_name' => $life->life_name,
            'life_detail' => $life->life_detail,
            'life_message' => $life->life_message,
            'user_id' => $life->user_id,
            'good' => $life->good,
            'release' => $life->release,
        ];

        // Retrieve cells associated with the life
        $lifeArray['cells'] = Cell::where('life_id', $life->life_id)->get();

        $result['life'] = $lifeArray;

        return response()->json($result);
    }


    private function formatUser($user)
    {
        return [
            'user_id' => $user->user_id,
            'img_path' => $user->img ? $user->img->img_path : null,
            'user_name' => $user->user_name,
            'life_id' => $user->life_id,
            'birth' => $user->birth,
            'blood_type' => $user->blood_type,
            'height' => $user->height,
            'hobby' => $user->hobby,
            'episode1' => $user->episode1,
            'episode2' => $user->episode2,
            'episode3' => $user->episode3,
            'episode4' => $user->episode4,
        ];
    }

    private function formatLife($life)
    {
        $commentsArray = [];
        foreach ($life->comments as $comment) {
            $commentUser = $comment->user;
            $comment_img_path = $commentUser->img ? $commentUser->img->img_path : null;
            $commentsArray[] = [
                'user_id' => $commentUser->user_id,
                'user_name' => $commentUser->user_name,
                'user_email' => $commentUser->user_mail,
                'img_path' => $comment_img_path,
                'comment' => $comment->comment
            ];
        }

        return [
            'life_id' => $life->life_id,
            'img_id' => $life->img_id,
            'img_path' => $life->img ? $life->img->img_path : null,
            'life_name' => $life->life_name,
            'life_detail' => $life->life_detail,
            'life_message' => $life->life_message,
            'user_id' => $life->user_id,
            'good' => $life->good,
            'release' => $life->release,
            'comments' => $commentsArray
        ];
    }

    public function incrementGood(Request $request)
    {
        $life = Life::find($request->life_id);

        if (is_null($life)) {
            return response()->json(['message' => 'Life not found'], 404);
        }

        $life->increment('good', $request->good);

        $life->refresh();

        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        $notification = new Notification;
        $notification->notification_message = $user->user_name . 'さんから' . $life->life_name . 'がいいねされました。';
        $notification->creator_id = $user->user_id;
        $notification->recipient_id = $life->user_id;
        $notification->save();

        $result = [];
        $result['message'] = 'successfully';
        $result['life'] = [
            'life_id' => $life->life_id,
            'life_name' => $life->life_name,
            'life_detail' => $life->life_detail,
            'life_message' => $life->life_message,
            'user_id' => $life->user_id,
            'img_id' => $life->img_id,
            'release' => $life->release,
            'good' => $life->good,
        ];

        return response()->json($result);
    }

    public function getRandomLifes(Request $request)
    {
        $lifes = Life::where('release', 1)
            ->with('img')
            ->inRandomOrder()
            ->take(20)
            ->get();

        $result = [];
        $result['message'] = 'successfully';

        foreach ($lifes as $life) {
            $result['lifes'][] = $this->formatLife($life);
        }

        return response()->json($result);
    }

    private function handleException($e)
    {
        return response()->json([
            'error' => '予期しないエラー',
            'message' => 'システムエラーが発生しました。 後でもう一度試してください。',
            'sys_error' => $e->getMessage()
        ], 500);
    }
}
