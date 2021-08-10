<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content', 'rate', 'user_id', 'location_id', 'locationType'
    ];

    const LOCATION_TYPE = [
        'lesson' => 0,
        'course' => 1
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()
    {
        if ($this->locationType == self::LOCATION_TYPE['course']) {
            return $this->belongsTo(Course::class, 'location_id');
        } elseif ($this->locationType == self::LOCATION_TYPE['lesson']) {
            return $this->belongsTo(Lesson::class, 'location_id');
        }
    }
}
