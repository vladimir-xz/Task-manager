<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class TaskStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskStatus $taskStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ?TaskStatus $taskStatus): bool
    {
        if (!$taskStatus) {
            return false;
        }
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskStatus $taskStatus): bool
    {
        return Auth::check();
    }
}
