<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'product_id', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
