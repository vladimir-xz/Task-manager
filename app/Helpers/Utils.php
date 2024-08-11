<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Utils
{
    /**
     * @template T
     * @param T $collection
     * @return T
     */
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (object $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
