<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // return User::all();
    }

    public function show(User $user)
    {
        // return $user;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = new User();

        $user->img_id = $data['img_id'];
        $user->user_mail = $data['user_mail'];
        $user->user_pass = bcrypt($data['user_pass']);
        $user->user_name = $data['user_name'];
        $user->life_id = $data['life_id'];
        $user->birth = $data['birth'];
        $user->height = $data['height'];
        $user->blood_type = $data['blood_type'];
        $user->hobby = $data['hobby'];
        $user->episode1 = $data['episode1'];
        $user->episode2 = $data['episode2'];
        $user->episode3 = $data['episode3'];
        $user->episode4 = $data['episode4'];
        $user->episode5 = $data['episode5'];
        $user->abilities = "General user";
        $user->token = Str::random(40);
        $user->token_deadline = Carbon::now()->addWeeks(2);

        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
