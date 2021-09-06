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

    public function documents()
    {
        return $this->hasMany(Document::class, 'lesson_id');
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

    public function getCheckLessonLearnedAttribute()
    {
        $checkLesson = [];
        if (Auth::user()) {
            $checkLesson = $this->students()->wherePivot('user_id', Auth::user()->id)->where('learned', config('variables.learned_lesson'))->count();
        }
        
        if ($checkLesson == config('variables.learned_lesson')) {
            return true;
        }

        return false;
    }

    public function getCheckLessonLearningAttribute()
    {
        $checkLesson = [];
        if (Auth::user()) {
            $checkLesson = $this->students()->wherePivot('user_id', Auth::user()->id)->where('learned', config('variables.learning_lesson'))->count();
        }
        
        if ($checkLesson == config('variables.learned_lesson')) {
            return true;
        }

        return false;
    }

    public function getLearningProgressAttribute()
    {
        $totalDocument = $this->documents()->count();
        $numberOfLearnedDocument = 0;
        $documents = $this->documents()->get();
        foreach ($documents as $document) {
            if ($document->getCheckDocumentLearnedAttribute()) {
                $numberOfLearnedDocument ++;
            }
        }

        if ($totalDocument != 0) {
            $progress = floor($numberOfLearnedDocument / $totalDocument * 100);
        } else {
            $progress = 0;
        }
        
        return $progress;
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
