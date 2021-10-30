<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'courses_tags', 'tag_id', 'course_id')->distinct();
    }

    public function isTagOfCourse($courseId)
    {
        $checkTag = $this->courses()->wherePivot('course_id', $courseId)->distinct('tag_id')->count();

        if ($checkTag == 1) {
            return true;
        }

        return false;
    }
}
