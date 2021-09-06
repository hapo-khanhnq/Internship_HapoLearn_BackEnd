<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'file_path' , 'type' , 'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'documents_users', 'document_id', 'user_id')->withPivot('learned');
    }

    public function teachers()
    {
        return $this->users()->where('role', User::ROLE['teacher']);
    }

    public function students()
    {
        return $this->users()->where('role', User::ROLE['student']);
    }

    public function getCheckDocumentLearnedAttribute()
    {
        $checkLesson = [];
        if (Auth::user()) {
            $checkLesson = $this->students()->wherePivot('user_id', Auth::user()->id)->where('learned', config('variables.learned_document'))->count();
        }
        
        if ($checkLesson == config('variables.learned_document')) {
            return true;
        }

        return false;
    }
}
