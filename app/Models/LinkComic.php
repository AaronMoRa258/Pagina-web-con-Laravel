<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkComic extends Model {
    protected $table = "links_comic";
    protected $fillable = ["comic_id", "image_id", "link"];

    public $timestamps = false;
}
