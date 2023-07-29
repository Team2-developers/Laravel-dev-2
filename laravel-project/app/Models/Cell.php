<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cell extends Model
{
    use SoftDeletes;

    protected $table = 'cells';
    protected $primaryKey = 'cell_id';
    protected $fillable = [
        'life_id',
        'cell_detail',
        'cell_no',
        'cell_point',
        'cell_color'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Define relationships
    public function life()
    {
        return $this->belongsTo(Life::class, 'life_id', 'life_id');
    }
}
