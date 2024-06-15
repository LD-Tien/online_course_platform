<?php

namespace App\Services\Category;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Models\Category;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetCategoryByQueryService extends BaseService
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        try {
            $builder = Category::query();

            /** Apply filter */
            if (isset($this->data['filters'])) {
                foreach ($this->data['filters'] as $column => $value) {
                    /** example $value = ['>', 5] | 5 */
                    [$operator, $valueFilter] = is_array($value) ? $value : ['=', $value];
                    $this->categoryRepository->applyFilter(
                        $builder,
                        $column,
                        $valueFilter,
                        $operator
                    );
                }
            }

            /** Apply search */
            $this->categoryRepository->applySearch(
                $builder,
                ['name', 'id'],
                $this->data['search']['searchText'] ?? ''
            );

            /** Apply sorts */
            if (isset($this->data['sorts'])) {
                foreach ($this->data['sorts'] as $column => $direction) {
                    /** example created_at => 'desc' */
                    $this->categoryRepository->applySort($builder, $column, $direction);
                }
            }

            /** Get paginate */
            if (isset($this->data['limit']) && is_numeric($this->data['limit'])) {
                return $builder->paginate($this->data['limit']);
            }

            /** Get all */
            return $builder->get();
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

