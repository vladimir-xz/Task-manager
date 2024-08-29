<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\TaskComment;
use App\Models\Task;
use App\Services\TaskNotification\TaskNotificationService;
use App\Models\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task, TaskComment $comment, TaskNotificationService $notification)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $recipientsId = array_filter($request->input('recipients', []));

        $comment->author()->associate($request->user());
        $comment->task()->associate($task);
        $comment->fill($data);

        $comment->save();
        $comment->recipients()->sync($recipientsId);

        $notification->store($recipientsId, 'new response', $comment);

        flash(__('flash.commentStored'))->success();
        return to_route('tasks.show', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task, TaskComment $comment)
    {
        if ($request->user()->cannot('update', $comment)) {
            abort(403);
        }

        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $recipients = array_filter($request->input('recipients', []));

        $comment->fill($data);
        $comment->save();
        $comment->recipients()->sync($recipients);

        TaskNotification::where('comment_id', $comment->id)
            ->whereNotIn('user_id', $recipients)
            ->delete();

        flash(__('flash.commentUpdated'))->success();
        return to_route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task, TaskComment $comment)
    {
        if ($request->user()->cannot('delete', $comment)) {
            abort(403);
        }

        flash(__('flash.commentDeleted'))->success();

        TaskNotification::where('comment_id', $comment->id)
            ->delete();

        $comment->recipients()->detach();
        $comment->delete();

        return to_route('tasks.show', $task);
    }
}
