<?php

namespace App\Services\Module;

use App\Interfaces\Module\ModuleRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class DeleteModuleService extends BaseService
{
    protected $moduleRepository;
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle()
    {
        try {
            return $this->moduleRepository->delete($this->data['id']);
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

