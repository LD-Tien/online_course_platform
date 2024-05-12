<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $table = 'module';

    protected $fillable = [
        'name',
        'ordinal_number',
        'course_id',
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
