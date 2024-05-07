<?php

namespace App\Interfaces;

interface CrudRepositoryInterface
{
    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function all();

    public function find(int $id);
}