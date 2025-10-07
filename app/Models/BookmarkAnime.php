<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkAnime extends Model {
    protected $table = "bookmarks_anime";
    protected $fillable = ["user", "anime_id"]; 

    public $timestamps = false;
}
