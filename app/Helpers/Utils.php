<?php

namespace App\Helpers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Utils
{
    /**
     * @param Collection $collection
     * @return array<int, string>
     */
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (Model $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
