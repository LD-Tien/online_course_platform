<?php

namespace App\Services\Module;

use App\Interfaces\Module\ModuleRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateModuleService extends BaseService
{
    protected $moduleRepository;
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle()
    {
        try {
            return $this->moduleRepository->update($this->data, $this->data['id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

