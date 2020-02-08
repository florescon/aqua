<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 
    ];


}
