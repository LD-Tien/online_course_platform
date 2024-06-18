<?php

namespace App\Repositories\Review;

use App\Interfaces\Review\ReviewRepositoryInterface;
use App\Models\UserReview;
use App\Repositories\BaseRepository;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(UserReview $review)
    {
        $this->model = $review;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }
}