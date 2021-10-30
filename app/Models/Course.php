<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsToMany(Tag::class, 'courses_tags', 'course_id', 'tag_id')->distinct();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'courses_users', 'course_id', 'user_id');
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

    public function getTotalOfRateAttribute()
    {
        return $this->reviews()->whereNotNull('rate')->count();
    }

    public function getAverageOfRateAttribute()
    {
        return $this->reviews()->whereNotNull('rate')->avg('rate');
    }

    public function getOtherCoursesAttribute()
    {
        return $this->withCount('students')->where('id', '<>', $this->id)->orderByDesc('students_count')->take(config('variables.number_of_other_courses'))->get();
    }

    public function getCheckStudentInCourseAttribute()
    {
        $checkStudent = [];
        if (Auth::user()) {
            $checkStudent = $this->users()->wherePivot('user_id', Auth::user()->id)->count();
        }
 
        if ($checkStudent == config('variables.student_in_course')) {
            return true;
        }

        return false;
    }

    public function getUsersOfCourseOfOneAdmin($adminUserId) {
        return $this->users()->where('user_id', '<>', $adminUserId)->get();
    }

    public function getNumberOfRate($rate)
    {
        return $this->reviews()->where('rate', $rate)->count();
    }

    public function getPercentOfNumberOfRate($rate)
    {
        if ($this->reviews()->whereNotNull('rate')->count() != 0) {
            $totalRate = $this->reviews()->whereNotNull('rate')->count();
            $numberOfRate = $this->getNumberOfRate($rate);
            $percent = floor($numberOfRate / $totalRate * 100);
        } else {
            $percent = 0;
        }
        return $percent;
    }

    public function getLearningProgressAttribute()
    {
        $totalLesson = $this->lessons()->count();
        $numberOfLearnedLesson = 0;
        $lessons = $this->lessons()->get();
        foreach ($lessons as $lesson) {
            if ($lesson->getCheckLessonLearnedAttribute()) {
                $numberOfLearnedLesson ++;
            }
        }

        if ($totalLesson != 0) {
            $progress = floor($numberOfLearnedLesson / $totalLesson * 100);
        } else {
            $progress = 0;
        }
        return $progress;
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['keyword'])) {
            $query->where('name', 'like', '%' . $data['keyword'] . '%')
                ->orWhere('description', 'like', '%' . $data['keyword'] . '%');
        }

        if (isset($data['teacher'])) {
            $query->whereHas('users', function ($subquery) use ($data) {
                $subquery->where('user_id', $data['teacher']);
            });
        }

        if (isset($data['number_of_learner'])) {
            if ($data['number_of_learner'] == config('variables.order_by.asc')) {
                $query->withCount('students')->orderBy('students_count');
            } else {
                $query->withCount('students')->orderByDesc('students_count');
            }
        }

        if (isset($data['learn_time'])) {
            if ($data['learn_time'] == config('variables.order_by.asc')) {
                $query->withSum('lessons', 'learn_time')->orderBy('lessons_sum_learn_time');
            } else {
                $query->withSum('lessons', 'learn_time')->orderByDesc('lessons_sum_learn_time');
            }
        }

        if (isset($data['number_of_lesson'])) {
            if ($data['number_of_lesson'] == config('variables.order_by.asc')) {
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

        if (isset($data['rating'])) {
            if ($data['rating'] == config('variables.order_by.asc')) {
                $query->withAvg('reviews', 'rate')->orderBy('reviews_avg_rate');
            } else {
                $query->withAvg('reviews', 'rate')->orderByDesc('reviews_avg_rate');
            }
        }

        if (isset($data['filter_status'])) {
            if ($data['filter_status'] == config('variables.filter_status.oldest')) {
                $query->orderBy('id');
            } else {
                $query->orderByDesc('id');
            }
        }

        return $query;
    }
}
