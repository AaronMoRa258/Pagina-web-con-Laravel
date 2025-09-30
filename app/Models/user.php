<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class user extends Authenticatable {
    use HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'Id';
    protected $keyType = 'int';
    protected $fillable = [
        'User',
        'Nombre',
        'Email',
        'password',
    ];
    protected $hidden = [
        'password',
        'Recordar_Token',
    ];

    public $incrementing = true;

    protected function casts(): array {
        return [
            'Email_Verificado' => 'datetime',
            'Password' => 'hashed',
        ];
    }

    public function getRememberTokenName() {
        return 'Recordar_Token';
    }
}
