<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Life;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'life_id' => ['required', 'integer', 'exists:lifes,life_id'],
            'comment' => ['required', 'max:255'],
        ]);

        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'ユーザが見つかりません'
            ], 404);
        }

        $life = Life::find($request->life_id);

        if (!$life) {
            return response()->json([
                'message' => '人生が見つかりません'
            ], 404);
        }

        try {
            $comment = Comment::create([
                'life_id' => $life->life_id,
                'user_id' => $user->user_id,
                'comment' => $request->comment,
            ]);

            $commentData = [
                'user_id' => $comment->user_id,
                'life_id' => $comment->life_id,
                'comment' => $comment->comment,
                'comment_id' => $comment->comment_id,
            ];


            return response()->json([
                'message' => 'successfully',
                'comment' => $commentData
            ]);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
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
