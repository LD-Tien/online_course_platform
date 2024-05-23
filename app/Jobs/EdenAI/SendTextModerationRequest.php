<?php

namespace App\Jobs\EdenAI;

use App\Interfaces\Moderation\ModerationRepositoryInterface;
use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTextModerationRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lesson;

    /**
     * Create a new job instance.
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = resolve(ModerationRepositoryInterface::class)->textModeration($this->lesson['description']);
            $this->lesson->update(['analysis_text_result_json' => $response->getBody()->getContents()]);
        } catch (\Exception $e) {
            \Log::error('Error when sending request to Eden AI: ' . $e);
        }
    }
}
