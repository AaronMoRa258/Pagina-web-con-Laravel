<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalListAnime extends Model {
    protected $table = "personal_lists_anime";
    protected $fillable = ["user", "anime_id", "list"]; 

    public $timestamps = false;
}
