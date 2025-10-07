<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkComic extends Model {
    protected $table = "bookmarks_comic";
    protected $fillable = ["user", "comic_id"];

    public $timestamps = false;
}
