<?php

namespace App\Services\Enrollment;

use App\Interfaces\Enrollment\EnrollmentRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class EnrollmentService extends BaseService
{
    protected $enrollment;
    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->enrollment = $enrollmentRepository;
    }

    public function handle()
    {
        try {
            return $this->enrollment->create($this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

