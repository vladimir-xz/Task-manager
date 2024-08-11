<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Termwind\Components\Hr;

class TaskStatus extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
