<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    protected $table = 'enrollment';
    const CREATED_AT = 'enrollment_at';
    const UPDATED_AT = 'completed_at';
}
