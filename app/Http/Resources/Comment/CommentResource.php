<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'parent_comment_id' => $this->parent_comment_id,
            'rating_number' => $this->getRatingNumber(),
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->name,
                'profile_photo_url' => $this->user->profile_photo_url ? config('app.url') . $this->user->profile_photo_url : '',
            ],
            'lesson_id' => $this->lesson_id,
            'replies' => CommentResource::collection($this->replies),
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($request->user()) {
            $userReactionComment = $this->reactions->where('user_id', $request->user()->id)->first();
            $data['user_reaction_comment'] = $userReactionComment ? $userReactionComment->reaction_type : null;
        }

        return $data;
    }
}
