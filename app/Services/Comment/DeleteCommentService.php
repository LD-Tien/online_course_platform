<?php

namespace App\Services\Comment;

use App\Interfaces\Comment\CommentRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class DeleteCommentService extends BaseService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function handle()
    {
        try {
            return $this->commentRepository->delete($this->data['id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

