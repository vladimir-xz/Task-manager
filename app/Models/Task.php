<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo('App\Models\TaskStatus');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to_id');
    }
}
