<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_title', 'meta_title', 'meta_description', 'meta_keywords', 'content'
    ];


    public function getRouteKeyName(){
        return 'url_key';
    }

}
