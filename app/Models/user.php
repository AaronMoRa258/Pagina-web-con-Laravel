<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail {
    use HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'user',
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'token_remember',
    ];

    public $incrementing = true;

    protected function casts(): array {
        return [
            'at_verified_email' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRememberTokenName() {
        return 'token_remember';
    }
}
