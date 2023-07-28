<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['user_pass'] = bcrypt($data['user_pass']);
            $data['abilities'] = "General user";
            $data['token'] = Str::random(40);
            $data['token_deadline'] = Carbon::now()->addWeeks(2);

            $user = User::create($data);

            return response()->json([
                'status' => 'success',
                'data' => $user
            ], 201);
        } catch (QueryException $e) {
            return $this->handleQueryException($e);
        }
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
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
}
