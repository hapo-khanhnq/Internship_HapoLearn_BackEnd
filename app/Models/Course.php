<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'image_path', 'description', 'learn_time', 'quizzes', 'price'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'courses_tags', 'course_id', 'tag_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'courses_users', 'course_id', 'user_id');
    }

    public function teacher()
    {
        return $this->users()->where('role', User::ROLE['teacher']);
    }

    public function students()
    {
        return $this->users()->where('role', User::ROLE['student']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'location_id')->where('locationType', Review::LOCATION_TYPE['course']);
    }

    public function getNumberOfStudentAttribute()
    {
        return $this->students()->count();
    }

    public function getNumberOfLessonAttribute()
    {
        return $this->lessons()->count();
    }

    public function getLearnTimeAttribute()
    {
        return $this->lessons()->sum('learn_time');
    }

    public function getNumberOfReviewAttribute()
    {
        return $this->reviews()->count();
    }

    public function getAverageOfRateAttribute()
    {
        return $this->reviews()->avg('rate');
    }

    public function scopeSearch($query, $data)
    {
        if (isset($data['course_keyword'])) {
            $query->where('name', 'like', '%' . $data['course_keyword'] . '%')
                ->orWhere('description', 'like', '%' . $data['course_keyword'] . '%');
        }

        return $query;
    }
    
    public function scopeFilter($query, $data)
    {

        if (isset($data['teacher'])) {
            $query->whereHas('users', function ($subquery) use ($data) {
                $subquery->where('user_id', $data['teacher']);
            });
        }

        if (isset($data['number_of_learner'])) {
            if ($data['number_of_learner'] == 'asc') {
                $query->withCount('students')->orderBy('students_count');
            } else {
                $query->withCount('students')->orderByDesc('students_count');
            }
        }

        if(isset($data['learn_time'])) {
            if($data['learn_time'] == 'asc') {
                $query->addSelect(['learn_course_time' => Lesson::selectRaw('sum(learn_time) as total_time')
                        ->whereColumn('course_id', 'courses.id')
                        ->groupBy('course_id')
                ])->orderBy('learn_course_time');
            } else {
                $query->addSelect(['learn_course_time' => Lesson::selectRaw('sum(learn_time) as total_time')
                        ->whereColumn('course_id', 'courses.id')
                        ->groupBy('course_id')
                ])->orderByDesc('learn_course_time');
            }
        }

        if(isset($data['number_of_lesson'])) {
            if($data['number_of_lesson'] == 'asc') {
                $query->withCount('lessons')->orderBy('lessons_count');
            } else {
                $query->withCount('lessons')->orderByDesc('lessons_count');
            }
        }

        if (isset($data['tag'])) {
            $query->whereHas('tags', function ($subquery) use ($data) {
                $subquery->where('tag_id', $data['tag']);
            });
        }

        if(isset($data['rating'])) {
            if($data['rating'] == 'asc') {
                $query->addSelect(['averate_of_course_rate'=> Review::selectRaw('avg(rate) as avg_rate')
                        ->whereColumn('location_id', 'courses.id')
                        ->where('locationType', Review::LOCATION_TYPE['course'])
                ])->orderBy('averate_of_course_rate');
            } else {
                $query->addSelect(['averate_of_course_rate'=> Review::selectRaw('avg(rate) as avg_rate')
                        ->whereColumn('location_id', 'courses.id')
                        ->where('locationType', Review::LOCATION_TYPE['course'])
                ])->orderByDesc('averate_of_course_rate');
            }
        }

        if(isset($data['filter_status'])) {
            if($data['filter_status'] == 'oldest') {
                $query->orderBy('id');
            } else {
                $query->orderByDesc('id');
            }
        }

        return $query;
    } 
}
