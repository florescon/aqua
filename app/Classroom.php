<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\ClassroomType;
use App\Models\Auth\User;
use App\Tag;

class Classroom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'schedule', 'days'
    ];


    public function setDaysAttribute($value)
    {
        $this->attributes['days'] = implode(', ', $value);
    }

    public function getDaysAttribute($value)
    {
        return explode(", ", $value);
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function classtype()
    {
        return $this->belongsTo(ClassroomType::class, 'classroom_type_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }


}
