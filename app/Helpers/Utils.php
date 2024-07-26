<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Utils
{
    public static function groupById(Collection $collection): array
    {
        return $collection->mapWithKeys(function ($record) {
            return [$record->id => $record->name];
        })->all();
    }
}
