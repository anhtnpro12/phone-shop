<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role_as'
    ];

    protected $hidden = [
        'password'
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'user_id');
    }
}
