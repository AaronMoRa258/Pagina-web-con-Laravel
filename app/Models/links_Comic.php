<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class links_Comic extends Model {
    protected $table = 'links_comic';
    protected $fillable = ['comic_Id', 'image_Id', 'link'];

    public $timestamps = false;
}
