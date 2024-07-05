<?php

namespace App\Repositories\Comment;

use App\Interfaces\Comment\CommentReactionRepositoryInterface;
use App\Models\UserCommentReaction;
use App\Repositories\BaseRepository;

class CommentReactionRepository extends BaseRepository implements CommentReactionRepositoryInterface
{
    public function __construct(UserCommentReaction $commentReaction)
    {
        $this->model = $commentReaction;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->model->updateOrInsert($conditions, $data);
    }
}