<?php

namespace App\Services\Review;

use App\Interfaces\Review\ReviewRepositoryInterface;
use App\Models\UserReview;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetReviewByQuery extends BaseService
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function handle()
    {
        try {
            $builder = UserReview::query();

            $builder->where('course_id', $this->data['filters']['course_id']);

            return $builder->get();
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

