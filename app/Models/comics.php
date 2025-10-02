<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comics extends Model
{
    protected $table = 'comics';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'description', 'page_Number', 'front_Page', 'type', 'condition']; 

    public $timestamps = false;
}
