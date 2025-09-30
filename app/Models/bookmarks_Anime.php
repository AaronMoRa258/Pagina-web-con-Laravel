<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookmarks_Anime extends Model {
    protected $table = 'bookmarks_anime';
    protected $fillable = ['user', 'anime_Id']; 

    public $timestamps = false;
}
