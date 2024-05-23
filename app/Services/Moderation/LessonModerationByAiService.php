<?php

namespace App\Services\Moderation;

use App\Interfaces\Moderation\ModerationRepositoryInterface;
use App\Jobs\EdenAI\SendTextModerationRequest;
use App\Jobs\EdenAI\SendVideoExplicitContentDetectionRequest;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class LessonModerationByAiService extends BaseService
{
    public function handle()
    {
        try {
            SendVideoExplicitContentDetectionRequest::dispatch($this->data['lesson']);
            SendTextModerationRequest::dispatch($this->data['lesson']);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

