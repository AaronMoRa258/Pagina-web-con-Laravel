<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class animes extends Model {
    protected $table = 'animes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'description', 'chapters', 'rating', 'image', 'type', 'year', 'season', 'condition']; 

    public $timestamps = false;
}
