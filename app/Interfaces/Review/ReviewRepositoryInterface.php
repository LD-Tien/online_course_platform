<?php

namespace App\Interfaces\Review;

use App\Interfaces\CrudRepositoryInterface;

interface ReviewRepositoryInterface extends CrudRepositoryInterface
{
    public function updateOrCreate(array $conditions, array $data);
}