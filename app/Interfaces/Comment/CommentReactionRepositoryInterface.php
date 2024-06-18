<?php

namespace App\Interfaces\Comment;

use App\Interfaces\CrudRepositoryInterface;

interface CommentReactionRepositoryInterface extends CrudRepositoryInterface
{
    public function updateOrCreate(array $conditions, array $data);
}