<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\TaskComment;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'content' => 'string|max:1000',
        ]);
        $recipientsId = array_filter($request->input('recipients', []));

        $comment = new TaskComment();
        $comment->author()->associate($request->user());
        $comment->task()->associate($task);
        $comment->fill($data);

        $comment->save();
        $comment->recipients()->sync($recipientsId);

        // Sending notifications
        foreach ([$task->author?->id, $task->assignedTo?->id, ...$recipientsId] as $userId) {
            $ifAlredyNotified = TaskNotification::where('task_id', $task->id)
                ->where('user_id', $userId)
                ->exists();
            if (!$ifAlredyNotified && $request->user()?->id != $userId) {
                $notification = new TaskNotification();
                $label = Label::where('name', 'new response')->first();
                $notification->task()->associate($task);
                $notification->recipient()->associate($userId);
                $notification->label()->associate($label);

                $notification->save();
            }
        }

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
            'content' => 'string|max:1000',
        ]);
        $recipients = $request->input('recipients');

        $comment->fill($data);
        $comment->save();
        $comment->recipients()->sync($recipients);

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
        $comment->recipients()->detach();
        $comment->delete();

        return to_route('tasks.show', $task);
    }
}
