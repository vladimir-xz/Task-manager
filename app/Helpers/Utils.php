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
        /** @var \Illuminate\Support\Collection $collection */
        return $collection->mapWithKeys(function (Label|Task|TaskStatus|User|null $record) {
            return [$record?->id => $record?->name];
        })->all();
    }
}
