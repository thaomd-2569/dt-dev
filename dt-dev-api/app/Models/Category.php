<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'position',
        'status',
        'image_path',
    ];
}
