<?php

namespace App\Models;

use App\Enums\ReactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_comment';

    protected $fillable = [
        'id',
        'parent_comment_id',
        'user_id',
        'lesson_id',
        'content'
    ];

    public function reactions(): HasMany
    {
        return $this->hasMany(UserCommentReaction::class, 'comment_id', 'id');
    }

    public function getRatingNumber(): int
    {
        return $this->reactions()->where('reaction_type', ReactionType::LIKE)->count() - $this->reactions()->where('reaction_type', ReactionType::DISLIKE)->count();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(UserComment::class, 'parent_comment_id', 'id');
    }
}
