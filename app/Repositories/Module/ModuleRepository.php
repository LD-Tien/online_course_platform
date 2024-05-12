<?php

namespace App\Repositories\Module;

use App\Interfaces\Module\ModuleRepositoryInterface;
use App\Models\Module;
use App\Repositories\BaseRepository;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function __construct(Module $module)
    {
        $this->model = $module;
    }
}