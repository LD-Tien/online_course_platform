<?php

namespace App\Repositories\Comment;

use App\Interfaces\Comment\CommentRepositoryInterface;
use App\Models\UserComment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(UserComment $comment)
    {
        $this->model = $comment;
    }
}