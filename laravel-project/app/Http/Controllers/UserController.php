<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['user_pass'] = bcrypt($data['user_pass']);
            $data['abilities'] = "General user";
            $data['token'] = Str::random(40);
            $data['token_deadline'] = Carbon::now()->addWeeks(2);

            $user = User::create($data);

            $img_path = $user->img ? $user->img->img_path : null;

            return response()->json([
                'message' => 'successfully',
                'user' => [
                    'user_id' => $user->user_id,
                    'user_mail' => $user->user_mail,
                    'user_name' => $user->user_name,
                    'img_path' => $img_path,
                    'user_token' => $user->token
                ]
            ], 201);
        } catch (QueryException $e) {
            return $this->handleQueryException($e);
        }
    }

    private function handleQueryException(QueryException $e)
    {
        if ($e->getCode() == 23000) {
            return response()->json([
                'error' => '入力項目の重複',
                'message' => '入力したメールアドレスは既に使用されています。',
                'sys_error' => $e
            ], 409);
        }

        return response()->json([
            'error' => '予期せぬエラー',
            'message' => 'システムエラーが発生しました。時間を置いて再度お試しください。',
            'sys_error' => $e
        ], 500);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('user_mail', 'user_pass');

        $user = User::where('user_mail', $credentials['user_mail'])->first();

        if (!$user || !Hash::check($credentials['user_pass'], $user->user_pass)) {
            return response()->json([
                'message' => 'Invalid email or password.'
            ], 401);
        }

        // Update token and token_deadline
        $user->token = Str::random(40);
        $user->token_deadline = Carbon::now()->addWeeks(2);
        $user->save();

        $img_path = $user->img ? $user->img->img_path : null;

        return response()->json([
            'message' => 'successfully',
            'user' => [
                'user_id' => $user->user_id,
                'user_mail' => $user->user_mail,
                'user_name' => $user->user_name,
                'img_path' => $img_path,
                'user_token' => $user->token
            ]
        ], 200);
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();

            $user = User::where('user_mail', $data['user_mail'])->first();

            if (!$user) {
                return response()->json([
                    'error' => 'ユーザーが見つかりません',
                    'message' => '指定されたメール アドレスを持つユーザーは存在しません。'
                ], 404);
            }

            // Update the user data
            if (isset($data['img_id'])) $user->img_id = $data['img_id'];
            if (isset($data['user_name'])) $user->user_name = $data['user_name'];
            if (isset($data['life_id'])) $user->life_id = $data['life_id'];
            if (isset($data['birth'])) $user->birth = $data['birth'];
            if (isset($data['blood_type'])) $user->blood_type = $data['blood_type'];
            if (isset($data['height'])) $user->height = $data['height'];
            if (isset($data['hobby'])) $user->hobby = $data['hobby'];
            if (isset($data['episode1'])) $user->episode1 = $data['episode1'];
            if (isset($data['episode2'])) $user->episode2 = $data['episode2'];
            if (isset($data['episode3'])) $user->episode3 = $data['episode3'];
            if (isset($data['episode4'])) $user->episode4 = $data['episode4'];
            if (isset($data['episode5'])) $user->episode5 = $data['episode5'];
            $user->save();

            $img_path = $user->img ? $user->img->img_path : null;

            return response()->json([
                'message' => 'successfully',
                'user' => [
                    'user_id' => $user->user_id,
                    'img_id' => $user->img_id,
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
                    'episode5' => $user->episode5,
                    'img_path' => $img_path
                ]
            ], 200);
        } catch (QueryException $e) {
            return $this->handleQueryException($e);
        }
    }

    public function getUser(Request $request)
    {

        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        if ($user) {

            $img_path = $user->img ? $user->img->img_path : null;
            return response()->json([
                'user_id' => $user->user_id,
                'img_id' => $user->img_id,
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
                'episode5' => $user->episode5,
                'img_path' => $img_path
            ], 200);
        } else {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }
    }
}
