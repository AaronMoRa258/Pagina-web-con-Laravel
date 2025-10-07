<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalListComic extends Model {
    protected $table = "personal_lists_comic";
    protected $fillable = ["user", "comic_id", "list"];

    public $timestamps = false;
}
