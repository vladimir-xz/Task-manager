<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Label;
use App\Models\Task;

class Notification extends Model
{
    use HasFactory;

    public function task(): BelongsTo
    {
        return $this->belongTo(Task::class);
    }

    public function recipient(): BelongsTo
    {
        return $this->belongTo(User::class);
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }
}
