<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
