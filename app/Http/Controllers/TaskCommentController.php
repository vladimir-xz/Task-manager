<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\TaskComment;
use App\Models\Task;
use App\Models\TaskNotification;
use Illuminate\Http\Request;

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
        $recipient = $request->input('recipients', []);

        $comment = new TaskComment();
        $comment->author()->associate($request->user());
        $comment->task()->associate($task);
        $comment->fill($data);

        $comment->save();
        $comment->recipients()->sync($recipient);


        $label = Label::where('name', 'new response');
        if ($task->assignedTo()->exists()) {
            $notification = TaskNotification::firstOrCreate([
                'task_id' => $task->id,
                'recipient_id' => $recipient,
            ]);
            $notification->label()->attach($label);
            $notification->save();
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
