<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal_Lists_Comic extends Model {
    protected $table = 'personal_lists_comic';
    protected $fillable = ['user', 'comic_Id', 'list'];

    public $timestamps = false;
}
