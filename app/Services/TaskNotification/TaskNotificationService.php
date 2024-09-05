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
    protected NotificationFactory $factory;

    public function __construct(NotificationFactory $notFactory)
    {
        $this->task = request('task', null);
        $this->comment = request('comment', null);
        $this->factory = $notFactory;
    }

    public function retrieveWithDelete()
    {
        $usersNotifications = $this->task
            ->notifications()
            ->where('user_id', request()->user()?->id)
            ->get();

        $result = clone $usersNotifications;

        $this->task->notifications()
            ->where('user_id', request()->user()?->id)
            ->delete();

        return $result;
    }

    public function deleteForComment()
    {
        $this->comment->notifications()->delete();
    }

    public function updateForComment(array $recipients)
    {
        $this->comment->notifications()->whereNotIn('user_id', $recipients)->delete();
    }

    public function storeSeveral(string $labelName, array $recipientsIds = [], ?TaskComment $comment = null)
    {
        // Saving notifications 'New Response' to database
        $label = Label::where('name', $labelName)->first();

        $notificationsToSave = collect($recipientsIds)
            ->reduce(function ($carry, $userId) use ($label, $comment) {
                if (request()->user()?->id == $userId || is_null($userId)) {
                    return $carry;
                }

                $notification = $this->factory->create();
                $notification->comment()->associate($comment);
                $notification->recipient()->associate($userId);
                $notification->label()->associate($label);
                $carry[] = $notification;

                return $carry;
            }, []);

        $this->task->notifications()->saveMany($notificationsToSave);
    }
}
