<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal_Lists_Anime extends Model {
    protected $table = 'personal_lists_anime';
    protected $fillable = ['user', 'anime_Id', 'list']; 

    public $timestamps = false;
}
