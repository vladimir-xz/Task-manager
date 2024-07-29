<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use stdClass;

class TaskPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task|stdClass $task): bool
    {
        return $user->id === $task->created_by_id;
    }
}
