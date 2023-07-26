<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

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
    ];

    protected $dates = [
        'birth',
        'token_deadline',
    ];
}
