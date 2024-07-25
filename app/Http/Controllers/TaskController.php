<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTasks = Task::all();

        $neededTasks = $allTasks->map(function ($record) {
            return (object) [
                'id' => $record->id,
                'statusName' => $record->status->name,
                'name' => $record->name,
                'author' => $record->author->name,
                'assignedTo' => $record->assignedTo?->name ?? null,
                'createdAt' => $record->created_at
            ];
        });
        $tasks = new Paginator($neededTasks, 15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $taskStatuses = TaskStatus::all();

        $usersByIds = $users->mapWithKeys(function (User $record) {
            return [$record->id => $record->name];
        })
            ->prepend(null, '')
            ->all();
        $statusesByIds = $taskStatuses->mapWithKeys(function (TaskStatus $record) {
            return [$record->id => $record->name];
        })->all();

        return view('tasks.create', compact('usersByIds', 'statusesByIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'status_id' => 'required|integer',
            'description' => 'string',
            'created_by_id' => 'prohibited|integer'
        ]);

        $data['created_by_id'] = $request->user()->id;
        $task = new Task();
        $task->fill($data);
        $task->save();

        flash(__('flash.taskCreated'))->success();

        return redirect()
        ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::select('id', 'name')->get();
        $taskStatuses = TaskStatus::all();

        $usersByIds = $users->mapWithKeys(function (User $record) {
            return [$record->id => $record->name];
        })
            ->prepend(null, '')
            ->all();
        $statusesByIds = $taskStatuses->mapWithKeys(function (TaskStatus $record) {
            return [$record->id => $record->name];
        })
            ->prepend(null, '')
            ->all();

        return view('tasks.edit', compact('task', 'usersByIds', 'statusesByIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'status_id' => 'required|integer',
            'description' => 'string',
            'created_by_id' => 'prohibited|integer'
        ]);

        $task->fill($data);
        $task->save();

        flash(__('flash.taskUpdated'))->success();

        return redirect()
        ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        if ($request->user()->id !== $task->created_by_id) {
            return abort(403);
        }
        // if (Gate::denies('delete-post', $task)) {
        //     abort(403);
        // }
        flash(__('flash.TaskDeleted'))->success();
        $task->delete();
        return redirect()
        ->route('tasks.index');
    }
}
