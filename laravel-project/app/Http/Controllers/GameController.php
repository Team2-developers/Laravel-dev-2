<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Events\LifeGameEvent;

class GameController extends Controller
{
    public function store(Request $request)
    {
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
        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        $game_id = $request->game_id;

        $gameUserCount = GameUser::where('game_id', $game_id)->count();
        if ($gameUserCount >= 4) {
            return response()->json(['error' => 'The game is full. No more users can be added.'], 400);
        }

        GameUser::create([
            'game_id' => $game_id,
            'user_id' => $user->user_id,
            'score' => 0,
            'current_cell' => 0,
        ]);
        // $game = Game::find($game_id);
        // LifeGameEvent::dispatch($game);
        $game = Game::find($game_id);
        $users = GameUser::where('game_id', $game->game_id)->with('user')->get();
        event(new LifeGameEvent($game, $users));

        return response()->json(['message' => 'User added to the game.']);
    }
}
