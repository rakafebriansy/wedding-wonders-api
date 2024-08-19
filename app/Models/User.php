<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['username', 'email', 'password'];
    protected $primaryKey = 'user_id';

    public function weddings()
    {
        return $this->hasMany(Wedding::class, 'user_id');
    }
}
