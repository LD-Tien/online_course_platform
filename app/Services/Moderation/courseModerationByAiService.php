<?php

namespace App\Services\Moderation;

use App\Jobs\EdenAI\SendTextModerationRequest;
use App\Jobs\EdenAI\SendVideoExplicitContentDetectionRequest;
use App\Services\BaseService;

class CourseModerationByAiService extends BaseService
{
    public function handle()
    {
        try {
            foreach ($this->data['course']['modules'] as $module) {
                foreach ($module['lessons'] as $lesson) {
                    SendVideoExplicitContentDetectionRequest::dispatch($lesson);
                    SendTextModerationRequest::dispatch($lesson);
                }
            }

            return true;
        } catch (\Exception $e) {
            \Log::error($e);

            return false;
        }
    }
}

