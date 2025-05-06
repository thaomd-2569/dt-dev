<?php

namespace Modules\Admin\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerRole extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'manager_roles';

    // Attributes that are mass assignable
    protected $fillable = [
        'name',
    ];

    // Attributes that should be hidden for arrays
    protected $hidden = [];

    // Attributes that should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
