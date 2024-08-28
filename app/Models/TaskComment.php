<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_comment_user', 'comment_id', 'user_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(TaskNotification::class, 'comment_id');
    }
}
