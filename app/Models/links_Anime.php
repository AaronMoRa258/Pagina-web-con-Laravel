<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class links_Anime extends Model {
    protected $table = 'links_anime';
    protected $fillable = ['anime_Id', 'chapter_Id', 'link'];

    public $timestamps = false;
}
