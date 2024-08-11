<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

// Illuminate\Database\Eloquent\Collection

class Utils
{
    public static function groupByIdWithName(Collection $collection): array
    {
        /** @var Collection<int, Illuminate\Database\Eloquent\Model> $collection */
        return $collection->mapWithKeys(function (\stdClass $record) {
            return [$record?->id => $record?->name];
        })->all();
    }
}
