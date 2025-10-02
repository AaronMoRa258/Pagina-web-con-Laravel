<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookmarks_Comic extends Model {
    protected $table = 'bookmarks_comic';
    protected $fillable = ['user', 'comic_Id'];

    public $timestamps = false;
}
