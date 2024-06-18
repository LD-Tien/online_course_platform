<?php

namespace App\Http\Controllers\Learner\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Services\Comment\CreateCommentService;
use App\Services\Comment\DeleteCommentService;
use App\Services\Comment\GetCommentByQueryService;
use App\Services\Comment\ReactionCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $result = resolve(GetCommentByQueryService::class)->setParams($request->query())->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => CommentResource::collection($result)
            ]);
        }

        return $this->responseErrors(__('messages.get_fail'));
    }

    public function store(Request $request)
    {
        $result = resolve(CreateCommentService::class)->setParams([
            ...$request->all(),
            'user_id' => Auth::id()
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => new CommentResource($result)
            ]);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    public function delete($commentId)
    {
        $result = resolve(DeleteCommentService::class)->setParams(['id' => $commentId])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.delete_success')
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }

    public function reaction(Request $request)
    {
        $result = resolve(ReactionCommentService::class)->setParams([
            ...$request->all(),
            'user_id' => Auth::id()
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
            ]);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }
}
