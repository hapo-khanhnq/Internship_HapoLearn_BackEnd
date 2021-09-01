<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'requirement', 'content', 'learn_time', 'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lessons_users', 'lesson_id', 'user_id')->withPivot('learned');
    }

    public function teachers()
    {
        return $this->users()->where('role', User::ROLE['teacher']);
    }

    public function students()
    {
        return $this->users()->where('role', User::ROLE['student']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'location_id')->where('locationType', Review::LOCATION_TYPE['lesson']);
    }

    public function getCheckLessonLearnedAttribute()
    {
        $checkLesson = [];
        if (Auth::user()) {
            $checkLesson = $this->students()->wherePivot('user_id', Auth::user()->id)->where('learned', config('variables.learnedLesson'))->get();
        }
        return count($checkLesson);
    }

    public function scopeSearch($query, $data, $courseId)
    {
        if (isset($data['keyword']) && isset($courseId)) {
            $query->whereHas('course', function ($subquery) use ($courseId) {
                $subquery->where('course_id', $courseId);
            })->where('name', 'like', '%' . $data['keyword'] . '%');
        }

        return $query;
    }
}
