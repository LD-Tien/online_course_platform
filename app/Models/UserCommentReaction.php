<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommentReaction extends Model
{
    use HasFactory;

    protected $table = 'user_comment_reaction';
}
