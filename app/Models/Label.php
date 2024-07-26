<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Label extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
