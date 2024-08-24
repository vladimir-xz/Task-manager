<?php

namespace App\Policies;

use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class TaskCommentPolicy
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
    public function view(User $user, TaskComment $taskComment): bool
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
    public function update(User $user, TaskComment $taskComment): bool
    {
        return $user->id == $taskComment->created_by_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskComment $taskComment): bool
    {
        return $user->id == $taskComment->created_by_id;
    }
}
