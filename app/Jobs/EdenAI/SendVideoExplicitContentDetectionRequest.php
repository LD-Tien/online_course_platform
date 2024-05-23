<?php

namespace App\Jobs\EdenAI;

use App\Interfaces\Moderation\ModerationRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVideoExplicitContentDetectionRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lessonData;

    public function __construct($lessonData)
    {
        $this->lessonData = $lessonData;
    }

    public function handle()
    {
        try {
            $videoFile = fopen(\Storage::path($this->lessonData['video_path']), 'r');
            $webHookUri = config('app.url') . '/api/eden-ai/webhook/moderation-video/' . $this->lessonData['id'];
            $response = resolve(ModerationRepositoryInterface::class)->detectExplicitContentInVideoFileAsync($videoFile, $webHookUri);
            \Log::info($response->getBody()->getContents());
        } catch (\Exception $e) {
            \Log::error('Error when sending request to Eden AI: ' . $e);
        }
    }
}
