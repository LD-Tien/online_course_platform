<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLesson extends Model
{
    use HasFactory;

    protected $table = 'user_lesson';

    const CREATED_AT = 'completed_at';
}
