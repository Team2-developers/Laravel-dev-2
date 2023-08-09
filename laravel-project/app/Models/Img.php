<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Img extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'img_id';

    protected $fillable = [
        'img_path',
    ];

    protected $table = 'imgs';
}
