<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class followers extends Model {
    protected $table = 'followers';
    protected $fillable = ['user', 'follow']; 

    public $timestamps = false;
}
