<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model {
    protected $table = "comics";
    protected $primaryKey = "id";
    protected $fillable = ["id", "name", "description", "page_number", "front_page", "type", "condition"]; 

    public $timestamps = false;
}
