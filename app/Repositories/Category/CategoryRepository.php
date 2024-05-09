<?php

namespace App\Repositories\Category;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}