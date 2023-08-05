<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameUser extends Model
{

    use SoftDeletes;

    protected $table = 'game_users';
    protected $primaryKey = 'game_user_id';
    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'user_id',
        'score',
        'current_cell',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
