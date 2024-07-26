<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class TaskStatus extends Model
{
    protected $dateFormat = 'd.m.Y';
    protected $fillable = [
        'name'
    ];

    public function tasks()
    {
        // У каждого пользователя много постов
        // hasMany определяется у модели, имеющей внешние ключи в других таблицах
        return $this->hasMany(Task::class, 'status_id');
    }
}
