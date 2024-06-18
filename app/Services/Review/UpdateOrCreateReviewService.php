<?php

namespace App\Services\Review;

use App\Interfaces\Review\ReviewRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateOrCreateReviewService extends BaseService
{
    protected $reviewRepository;
    protected $conditions;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function handle()
    {
        try {
            return $this->reviewRepository->updateOrCreate($this->conditions, $this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }

    public function setParams($data = null)
    {
        $this->data = $data;
        $this->conditions = [
            'user_id' => (int) $data['user_id'],
            'course_id' => (int) $data['course_id']
        ];

        return $this;
    }
}

