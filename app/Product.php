<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductDetail;
use Carbon;

class Product extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'quantity', 'price', 'type', 'status'
    ];

    public function detail()
    {
        return $this->hasMany(ProductDetail::class)->orderBy('updated_at', 'desc');
    }


    /**
     * Get the product's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Get the product's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

    /**
     * Get the product's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

}
