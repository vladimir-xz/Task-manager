<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Utils
{
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (\stdClass $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
