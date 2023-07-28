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

            $img_pass = $user->img ? $user->img->img_pass : null;

            return response()->json([
                'message' => 'successfully',
                'user' => [
                    'user_id' => $user->user_id,
                    'user_mail' => $user->user_mail,
                    'user_name' => $user->user_name,
                    'img_pass' => $img_pass,
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

        $img_pass = $user->img ? $user->img->img_pass : null;

        return response()->json([
            'message' => 'successfully',
            'user' => [
                'user_id' => $user->user_id,
                'user_mail' => $user->user_mail,
                'user_name' => $user->user_name,
                'img_pass' => $img_pass,
                'user_token' => $user->token
            ]
        ], 200);
    }
}
