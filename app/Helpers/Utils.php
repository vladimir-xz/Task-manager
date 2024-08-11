<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Utils
{
    /**
     * @template T of Illuminate\Database\Eloquent\Collection
     * @param T $collection
     * @return T array
     */
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (object $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
