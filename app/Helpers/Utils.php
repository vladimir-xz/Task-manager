<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Utils
{
    public static function groupById(Collection $collection, string|bool $initValue = false): array
    {
        $nameByIds = $collection->mapWithKeys(function ($record) {
            return [$record->id => $record->name];
        });
        if ($initValue !== false) {
            $nameByIds->prepend($initValue, null);
        }
        return $nameByIds->all();
    }
}
