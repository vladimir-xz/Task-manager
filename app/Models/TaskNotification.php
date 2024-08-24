<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaskNotification extends Model
{
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function recipients(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }
}
