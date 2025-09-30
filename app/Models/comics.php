<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comics extends Model
{
    protected $table = 'comics';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'page_Number', 'front_Page']; 

    public $timestamps = false;
}
