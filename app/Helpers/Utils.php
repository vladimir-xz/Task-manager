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
     * @template TKey of array-key
     * @template TModel of \Illuminate\Database\Eloquent\Model
     *
     * @extends \Illuminate\Support\Collection<TKey, TModel>
     * @param callable(Model $model): array<TKey, TValue> $callback
     * @return array<TKey, TValue>
     */
    public static function groupByIdWithName(Collection $collection): array
    {
        return $collection->mapWithKeys(function (Model $record) {
            return [$record->id => $record->name];
        })->all();
    }
}
