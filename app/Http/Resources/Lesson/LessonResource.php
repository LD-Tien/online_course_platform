<?php

namespace App\Http\Resources\Lesson;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'ordinal_number' => $this->ordinal_number,
            'description' => $this->description,
            'module_id' => $this->module_id,
            'video_path' => Storage::url($this->video_path),
            'is_preview' => $this->is_preview,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($request->user()->isModerator()) {
            $data['analysis_text_result_json'] = json_decode($this->analysis_text_result_json);
            $data['analysis_video_result_json'] = json_decode($this->analysis_video_result_json);
        }

        return $data;
    }
}
