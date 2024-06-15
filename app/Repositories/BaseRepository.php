<?php

namespace App\Repositories;

use App\Interfaces\CrudRepositoryInterface;
use App\Interfaces\SearchSortFilterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseRepository implements CrudRepositoryInterface, SearchSortFilterRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    /**
     * Apply filter to builder
     * 
     * @param Builder $builder
     * @param string $column
     * @param string $value
     * @param string $operator
     * 
     * @return Builder
     */
    public function applyFilter(
        Builder $builder,
        string $column,
        string $value,
        string $operator = '='
    ) {
        return $builder->where($column, $operator, $value);
    }

    /**
     * Apply search to builder
     * 
     * @param Builder $builder
     * @param array $columns
     * @param string $value
     * 
     * @return Builder
     */
    public function applySearch(
        Builder $builder,
        array $columns,
        string $value
    ) {
        return $builder->where(function ($builder) use ($columns, $value) {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'like', '%' . $value . '%');
            }
        });
    }

    /**
     * Apply sort to builder
     * 
     * @param Builder $builder
     * @param string $column
     * @param string $direction
     * 
     * @return Builder
     */
    public function applySort(
        Builder $builder,
        string $column,
        string $direction = 'asc'
    ) {
        return $builder->orderBy($column, $direction);
    }
}