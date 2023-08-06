<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\GameEvent;
use App\Models\User;
use App\Models\Life;
use App\Models\Cell;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Events\LifeGameEvent;

class GameController extends Controller
{
    public function store(Request $request)
    {

        try {
            $data = $request->all();
            $data['life_id'] = null;
            $data['game_turn'] = 'host';

            $game = Game::create($data);

            $token = $request->bearerToken();
            $user = User::where('token', $token)->first();

            $img_path = $user->img ? $user->img->img_path : null;

            GameUser::create([
                'game_id' => $game->game_id,
                'user_id' => $user->user_id,
                'score' => 0,
                'current_cell' => 0,
            ]);

            $qrData = [
                'game_id' => $game->game_id,
                'user_id' => $user->user_id,
                'user_name' => $user->user_name,
                'user_mail' => $user->user_mail,
                'img_path' => $img_path
            ];

            $svgWithoutDeclaration = $this->generateQrCode($qrData);

            $response = [
                'message' => 'successfully',
                'svg' => $svgWithoutDeclaration,
                'game_id' => $game->game_id,
            ];

            return response()->json($response);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    private function generateQrCode(array $qrData): string
    {
        $queryParams = http_build_query($qrData);

        $svg = QrCode::format('svg')->size(200)->generate('http://localhost:8080/RoomJoin?' . $queryParams);

        // Remove XML Declaration
        $dom = new \DOMDocument;
        $dom->loadXML($svg);
        return $dom->saveXML($dom->documentElement);
    }

    public function addUserToGame(Request $request)
    {

        try {
            $token = $request->bearerToken();
            $user = User::where('token', $token)->first();

            $game_id = $request->game_id;

            $gameUserCount = GameUser::where('game_id', $game_id)->count();
            if ($gameUserCount >= 4) {
                return response()->json(['message' => 'メンバーがいっぱいで参加できません'], 400);
            }

            GameUser::create([
                'game_id' => $game_id,
                'user_id' => $user->user_id,
                'score' => 0,
                'current_cell' => 0,
            ]);
            $game = Game::find($game_id);
            $users = GameUser::where('game_id', $game->game_id)->with('user')->get();
            $life = Life::where('life_id', $game->life_id)->with('cells')->first();
            $lifeArray = $life->toArray();
            $eventname = 'useradd';
            event(new LifeGameEvent($game, $lifeArray, $users, $eventname));

            return response()->json([
                'message' => 'successfully',
                'game_id' => $game->game_id
            ]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function StartGame(Request $request)
    {

        try {
            $game_id = $request->game_id;

            $token = $request->bearerToken();
            $currentUser = User::where('token', $token)->first();
            $gameUserCount = GameUser::where('game_id', $game_id)->where('user_id', $currentUser->user_id)->count();
            if ($gameUserCount < 1) {
                return response()->json(['message' => '現在のユーザーはゲームに参加していません'], 400);
            }

            $gameUserCount = GameUser::where('game_id', $game_id)->count();
            if ($gameUserCount < 4) {
                return response()->json(['message' => 'メンバーが足りていません'], 400);
            }

            // Gameの状態を'started'に更新
            $game = Game::find($game_id);
            $game->game_status = 'started';
            $game->game_turn = 'user1';

            $users = GameUser::where('game_id', $game_id)->with('user')->get();

            $lifeIds = $users->map(function ($gameUser) {
                $user = User::find($gameUser->user_id);
                return $user->life_id;
            })->filter()->toArray();  // null をフィルタリング

            if (count($lifeIds) < 1) {
                return response()->json(['message' => 'life_idが無いためゲームを始めることができません'], 400);
            }

            // ランダムに一つのlife_idを選択して保存します
            $randomIndex = array_rand($lifeIds);
            $game->life_id = $lifeIds[$randomIndex];
            $game->save();

            $life = Life::where('life_id', $game->life_id)->with('cells')->first();
            $lifeArray = $life->toArray();
            $eventname = 'gamestart';
            event(new LifeGameEvent($game, $lifeArray, $users, $eventname));
            return response()->json([
                'message' => 'successfully'
            ]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateGameAndGameUser(Request $request)
    {

        try {
            $game_id = $request->game_id;
            $score = $request->score;
            $current_cell = $request->current_cell;

            $token = $request->bearerToken();
            $currentUser = User::where('token', $token)->first();

            $gameUser = GameUser::where('game_id', $game_id)->where('user_id', $currentUser->user_id)->first();

            if (!$gameUser) {
                return response()->json(['message' => '現在のユーザーはゲームに参加していません'], 400);
            }

            $game = Game::find($game_id);

            $users = GameUser::where('game_id', $game_id)->with('user')->get();
            $users_id = $users->pluck('user_id')->toArray();
            $currentUserIndex = array_search($currentUser->user_id, $users_id);

            if (!$this->validateUserTurn($game, $currentUserIndex)) {
                return response()->json(['message' => 'あなたの番ではありません'], 400);
            }

            $gameUser->score = $score;
            $gameUser->current_cell = $current_cell;
            $gameUser->save();

            $game = $this->updateGameTurn($game, $current_cell);

            $eventname = 'user_turn';
            $life = Life::where('life_id', $game->life_id)->with('cells')->first();
            $lifeArray = $life->toArray();
            if (in_array($current_cell, [1, 2, 3])) {
                $randomGameEvent = GameEvent::inRandomOrder()->first();
                $lifeArray['event'] = $randomGameEvent;

                $eventname = 'user_event';
            }
            event(new LifeGameEvent($game, $lifeArray, $users, $eventname));

            return response()->json([
                'message' => 'successfully'
            ]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    private function validateUserTurn($game, $currentUserIndex)
    {
        $turns = ['user1' => 0, 'user2' => 1, 'user3' => 2, 'user4' => 3];
        return array_key_exists($game->game_turn, $turns) && $turns[$game->game_turn] == $currentUserIndex;
    }

    private function updateGameTurn($game, $current_user_cell)
    {
        $turns = ['user1' => 'user2', 'user2' => 'user3', 'user3' => 'user4', 'user4' => 'user1'];

        $gameUsers = GameUser::where('game_id', $game->game_id)->with('user')->get();

        while (true) {
            if (array_key_exists($game->game_turn, $turns)) {
                $game->game_turn = $turns[$game->game_turn];
            } else {
                break;
            }

            $nextUserIndex = array_search($game->game_turn, array_keys($turns));
            $nextUser = $gameUsers[$nextUserIndex];

            if ($nextUser->current_cell <= 27) {
                break;
            }

            if ($current_user_cell == 28) {
                $allReached28 = true;
                foreach ($gameUsers as $user) {
                    if ($user->current_cell < 28) {
                        $allReached28 = false;
                        break;
                    }
                }
                if ($allReached28) {
                    $game->game_status = 'finished';
                    break;
                }
            }
        }

        $game->save();
        return $game;
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
