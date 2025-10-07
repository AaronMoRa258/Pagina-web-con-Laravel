<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model {
    protected $table = "animes";
    protected $primaryKey = "id";
    protected $fillable = ["id", "name", "description", "chapters_number", "rating", "image", "type", "year", "season", "condition"]; 

    public $timestamps = false;
}
