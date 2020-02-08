<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use App\Models\Auth\User;
use App\PaymentMethod;
use App\Payment;
use Carbon;

class Subscription extends Model
{

    use SoftDeletes, CascadeSoftDeletes; 

    protected $cascadeDeletes = ['payments'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'comment', 'start_date', 'finish_date', 'payment_method_id', 'ticket_text', 'box'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generated_by()
    {
        return $this->belongsTo(User::class, 'audi_id');
    }

    public function payments_one()
    {
        return $this->hasOne(Payment::class)->latest();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('updated_at', 'desc');
    }


    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function setStartDateAttribute($value): void
    {
      $this->attributes['start_date'] =
        Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }



    /**
     * Get the inscription's start_date.
     *
     * @param  string  $value
     * @return string
     */
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    /**
     * Get the inscription's finish_date.
     *
     * @param  string  $value
     * @return string
     */
    public function getFinishDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // public function setFinishDateAttribute($value): void
    // {
    //   $this->attributes['finish_date'] =
    //     Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    // }

    /**
     * Get the inscription's comment.
     *
     * @param  string  $value
     * @return string
     */
    public function getCommentAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    /**
     * Get the inscription's ticket_text.
     *
     * @param  string  $value
     * @return string
     */
    public function getTicketTextAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    /**
     * Get the inscription's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

    /**
     * Get the inscription's created_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s a');
    }

}
