<?php

namespace App\Services\TaskNotification;

use App\Models\TaskNotification;

class NotificationFactory
{
    public function create()
    {
        return new TaskNotification();
    }
}
