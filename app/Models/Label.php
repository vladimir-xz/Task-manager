<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description#
 */

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(TaskNotification::class, 'label_id');
    }
}
