<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
use App\Tag;

class ClassroomTag extends Model
{
	protected $fillable = [
        'classroom_id', 'tag_id',
    ];

    public function classroom(){
    	return $this->belongsTo(Classroom::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }



}
