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
                    if (is_null($lesson['analysis_video_result_json']))
                        SendVideoExplicitContentDetectionRequest::dispatch($lesson);
                    if (is_null($lesson['analysis_text_result_json']))
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

