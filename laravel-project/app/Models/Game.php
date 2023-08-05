<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $table = 'games';
    protected $primaryKey = 'game_id';
    public $timestamps = true;

    protected $fillable = [
        'game_status',
        'game_turn',
        'life_id'
    ];

    public function gameUsers()
    {
        return $this->hasMany(GameUser::class, 'game_id', 'game_id');
    }
}
