<?php

namespace App\Services\TaskNotification;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Models\TaskComment;
use App\Models\Task;
use App\Models\TaskNotification;

class TaskNotificationService
{
    protected Task $task;
    protected ?TaskComment $comment;

    public function retrieveWithDelete($task)
    {
        $usersNotifications = $task->notifications()
            ->where('user_id', request()->user()?->id)
            ->clone();

        $task->notifications()
            ->where('user_id', request()->user()?->id)
            ->delete();

        return $usersNotifications;
    }

    public function delete()
    {
        $this->comment->notifications()->delete();
    }

    public function update(array $recipients)
    {
        $this->comment->notifications()->whereNotIn('user_id', $recipients)->delete();
    }

    /**
     * Store a number of newly created resource in storage.
     */
    public function storeSeveral(TaskComment $comment, array $recipientsIds)
    {
        // Saving notifications 'New Response' to database
        $label = Label::where('name', 'new response')->first();

        $notificationsToSave = collect($recipientsIds)
            ->map(function ($userId) use ($label, $comment) {
                if (request()->user()?->id == $userId || is_null($userId)) {
                    return;
                }

                $notification = new TaskNotification();
                $notification->task()->associate($comment->task);
                $notification->recipient()->associate($userId);
                $notification->label()->associate($label);
                return $notification;
            })->all();

        $comment->notifications()->saveMany($notificationsToSave);
    }
}
