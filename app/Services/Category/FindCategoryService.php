<?php

namespace App\Services\Category;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class FindCategoryService extends BaseService
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        try {
            return $this->categoryRepository->find($this->data['id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

