<?php

namespace App\Http\Resources\Common\Course;

use App\Http\Resources\Common\Category\CategoryResource;
use App\Http\Resources\Common\User\UserResource;
use App\Http\Resources\Module\ModuleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseResource extends JsonResource
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
            'thumbnail' => $this->thumbnail_path ? config('app.url') . Storage::url($this->thumbnail_path) : null,
            'course_name' => $this->course_name,
            'price' => $this->price,
            'category' => new CategoryResource($this->category),
            'author' => new UserResource($this->user),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        /** Set detail information */
        if ($request->route()->getActionMethod() === 'show') {
            $data['description'] = $this->description;
            $data['modules'] = ModuleResource::collection($this->modules);
        }

        return $data;
    }
}
