<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class ClassroomType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];


    /**
     * Get the type's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

    /**
     * Get the type's updated_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }


}
