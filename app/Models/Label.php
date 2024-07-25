<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task');
    }
}
