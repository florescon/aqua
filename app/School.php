<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class School extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address'
    ];


    /**
     * Get the school's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Get the school's address.
     *
     * @param  string  $value
     * @return string
     */
    public function getAddressAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Get the school's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

    /**
     * Get the school's updated_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

}
