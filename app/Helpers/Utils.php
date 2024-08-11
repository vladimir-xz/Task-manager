<?php

namespace App\Helpers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Collection;

class Utils
{
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (Task|TaskStatus|Label $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
