<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_review';

    protected $fillable = [
        'course_id',
        'user_id',
        'rating_value',
        'comment'
    ];

    protected $primaryKey = 'course_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
