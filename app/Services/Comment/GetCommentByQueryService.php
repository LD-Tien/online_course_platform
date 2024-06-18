<?php

namespace App\Services\Comment;

use App\Interfaces\Comment\CommentRepositoryInterface;
use App\Models\UserComment;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetCommentByQueryService extends BaseService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function handle()
    {
        try {
            $builder = UserComment::query();

            $builder->where('lesson_id', $this->data['filters']['lesson_id']);
            $builder->where('parent_comment_id', null);

            return $builder->get();
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

