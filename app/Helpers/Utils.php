<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

// Illuminate\Database\Eloquent\Collection

class Utils
{
    /**
     * @param T $collection
     */
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (object $record) {
            return [$record?->id => $record?->name];
        })->all();
    }
}
