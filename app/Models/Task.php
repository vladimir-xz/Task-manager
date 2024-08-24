<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'assigned_to_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'task_id');
    }

    public function notifications(): HasMany
    {
        return $$this->hasMany(Notification::class, 'task_id');
    }
}
