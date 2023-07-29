<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Life;
use App\Models\Cell;
use Illuminate\Support\Arr;
use App\Models\User;

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
                'cells.*.cell_id' => ['required', 'integer', 'exists:cells,cell_id'],
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

                foreach ($request->cells as $cellData) {
                    $cell = Cell::find($cellData['cell_id']);
                    if ($cell->life_id !== $life->life_id) {
                        throw new \Exception("無効な cell_id: Lifeに属していません");
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

    private function handleException($e)
    {
        return response()->json([
            'error' => '予期しないエラー',
            'message' => 'システムエラーが発生しました。 後でもう一度試してください。',
            'sys_error' => $e->getMessage()
        ], 500);
    }
}
