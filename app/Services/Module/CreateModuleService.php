<?php

namespace App\Services\Module;

use App\Interfaces\Module\ModuleRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class CreateModuleService extends BaseService
{
    protected $moduleRepository;
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle()
    {
        try {
            return $this->moduleRepository->create($this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

