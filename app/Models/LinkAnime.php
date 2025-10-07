<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkAnime extends Model {
    protected $table = "links_anime";
    protected $fillable = ["anime_id", "chapter_id", "link"];

    public $timestamps = false;
}
