<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommentReaction extends Model
{
    use HasFactory;

    protected $table = 'user_comment_reaction';

    protected $fillable = [
        'user_id',
        'comment_id',
        'reaction_type'
    ];

    protected $primaryKey = 'comment_id';
}
