<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'content' => 'string|max:1000',
        ]);
        $recipients = $request->input('recipients');

        $comment = new Comment();
        $comment->author()->associate($request->user());
        $comment->task()->associate($task);
        $comment->fill($data);

        $comment->save();
        $comment->recipients()->attach($recipients);

        flash(__('flash.commentStores'))->success();
        return to_route('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task, Comment $comment)
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
    public function destroy(Request $request, Task $task, Comment $comment)
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
