<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'img_id',
        'user_mail',
        'user_pass',
        'user_name',
        'life_id',
        'birth',
        'height',
        'blood_type',
        'hobby',
        'episode1',
        'episode2',
        'episode3',
        'episode4',
        'episode5',
        'abilities',
        'token',
        'token_deadline',
    ];

    protected $hidden = [
        'user_pass',
        'token',
        'abilities',
        'token_deadline',
    ];

    protected $dates = [
        'birth',
        'token_deadline',
    ];

    public function img()
    {
        return $this->belongsTo('App\Models\Img', 'img_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_user', 'user_id');
    }
}
