<?php

namespace Modules\Admin\App\Models;

use App\Models\Traits\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    // Table associated with the model
    protected $table = 'managers';

    // Attributes that are mass assignable
    protected $fillable = [
        'login_id',
        'password',
        'role_id',
        'created_at',
        'updated_at',
    ];

    // Attributes that should be hidden for arrays
    protected $hidden = [
        'password',
    ];

    // Attributes that should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(ManagerRole::class, 'role_id');
    }

    public function getRoleAttribute()
    {
        return $this->role()->first()->name ?? null;
    }
}
