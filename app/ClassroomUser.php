<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
use App\Models\Auth\User;
use App\ClassroomType;

class ClassroomUser extends Model
{


	protected $fillable = [
        'classroom_id', 'user_id',
    ];


    public function classroom(){
    	return $this->belongsTo(Classroom::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function classroom_type()
    {
        return $this->belongsTo(ClassroomType::class, 'classroom_type_id');
    }


}
