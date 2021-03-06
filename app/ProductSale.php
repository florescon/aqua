<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Sale;
use App\Product;

class ProductSale extends Model
{

    protected $table = 'product_sale';

	protected $fillable = [
        'sale_id', 'product_id', 'quantity', 'price'
    ];

    public function product_detail()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function sale(){
    	return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}
