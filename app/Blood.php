<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class Blood extends Model
{

	/**
	* Attributes that should be mass-assignable.
	*
	* @var array
	*/
	protected $fillable = [
	  'name'
	];


}
