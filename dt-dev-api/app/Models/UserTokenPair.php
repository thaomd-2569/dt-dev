<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTokenPair extends Model
{
    protected $fillable = [
        'user_id',
        'access_token_id',
        'refresh_token_id',
    ];
}
