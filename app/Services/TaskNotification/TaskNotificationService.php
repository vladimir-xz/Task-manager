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

    public function __construct()
    {
        $this->task = request('task', null);
        $this->comment = request('comment', null);
    }

    public function retrieveWithDelete($task)
    {
        $notification = Task::find($this->task);
        $usersNotifications = Task::find($this->task)
            ->notifications()
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
    public function store(array $recipientsIds = [], string $label = 'new response', ?TaskComment $comment = null)
    {
        // Saving notifications 'New Response' to database
        $label = Label::where('name', $label)->first();

        $notificationsToSave = collect([$this->task?->id, $this->task?->assignedTo->id, ...$recipientsIds])
            ->reduce(function ($carry, $userId) use ($label, $comment) {
                var_dump($userId);
                if (request()->user()?->id == $userId || is_null($userId)) {
                    return $carry;
                }

                $notification = new TaskNotification();
                $notification->comment()->associate($comment);
                $notification->recipient()->associate($userId);
                $notification->label()->associate($label);
                $carry[] = $notification;

                return $carry;
            }, []);

        $this->task->notifications()->saveMany($notificationsToSave);
    }
}
