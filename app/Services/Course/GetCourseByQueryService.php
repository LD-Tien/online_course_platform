<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Models\Course;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetCourseByQueryService extends BaseService
{
    protected $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        try {
            $builder = Course::query();

            /** Apply filter */
            if (isset($this->data['filters'])) {
                foreach ($this->data['filters'] as $column => $value) {
                    /** example $value = ['>', 5] | 5 */
                    [$operator, $valueFilter] = is_array($value) ? $value : ['=', $value];
                    $this->courseRepository->applyFilter(
                        $builder,
                        $column,
                        $valueFilter,
                        $operator
                    );
                }
            }

            /** Apply search */
            $this->courseRepository->applySearch(
                $builder,
                ['course_name', 'id'],
                $this->data['search']['searchText'] ?? ''
            );

            /** Apply sorts */
            if (isset($this->data['sorts'])) {
                foreach ($this->data['sorts'] as $column => $direction) {
                    /** example created_at => 'desc' */
                    $this->courseRepository->applySort($builder, $column, $direction);
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

