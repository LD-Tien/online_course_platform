<?php

namespace App\Services\Comment;

use App\Interfaces\Comment\CommentReactionRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class ReactionCommentService extends BaseService
{
    protected $commentReactionRepository;
    protected $conditions;

    public function __construct(CommentReactionRepositoryInterface $commentReactionRepository)
    {
        $this->commentReactionRepository = $commentReactionRepository;
    }

    public function handle()
    {
        try {
            return $this->commentReactionRepository->updateOrCreate($this->conditions, $this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }

    public function setParams($data = null)
    {
        $this->data = $data;
        $this->conditions = [
            'user_id' => $data['user_id'],
            'comment_id' => $data['comment_id']
        ];

        return $this;
    }
}

