<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursesUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $filable = [
        'course_id', 'user_id'
    ];
}
