<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Life extends Model
{
    use SoftDeletes;

    protected $table = 'lifes';
    protected $primaryKey = 'life_id';
    protected $fillable = [
        'img_id',
        'life_name',
        'life_detail',
        'life_message',
        'user_id',
        'good',
        'release'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function img()
    {
        return $this->belongsTo(Img::class, 'img_id', 'img_id');
    }

    public function cells()
    {
        return $this->hasMany(Cell::class, 'life_id', 'life_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'life_id', 'life_id');
    }
}
