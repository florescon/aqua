<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Cart;
use App\Models\Auth\User;
use App\PaymentMethod;
use App\ProductSale;
use App\Product;

class Sale extends Model
{

    use SoftDeletes; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function products()
    {
        return $this->hasMany(ProductSale::class);
    }

    public function generated_by()
    {
        return $this->belongsTo(User::class, 'audi_id');
    }


}
