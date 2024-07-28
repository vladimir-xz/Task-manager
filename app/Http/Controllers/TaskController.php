<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\Label;
use App\Helpers\Utils;
use App\Http\Requests\TaskRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', null);
        $allTasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $statusesByIds = Utils::groupByIdWithName(User::all());
        $usersByIds = Utils::groupByIdWithName(TaskStatus::all());

        $neededTasks = $allTasks->map(function ($record) {
            return (object) [
                'id' => $record->id,
                'statusName' => $record->status->name,
                'name' => $record->name,
                'author' => $record->author->name,
                'assignedTo' => $record->assignedTo?->name ?? null,
                'createdAt' => $record->created_at->format('d.m.Y')
            ];
        });
        $tasks = new Paginator($neededTasks, 15);
        return view('tasks.index', compact('tasks', 'usersByIds', 'statusesByIds', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usersByIds = Utils::groupByIdWithName(User::all());
        $statusesByIds = Utils::groupByIdWithName(TaskStatus::all());
        $labelsById = Utils::groupByIdWithName(Label::all());

        return view('tasks.create', compact('usersByIds', 'statusesByIds', 'labelsById'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['name'] = $request->validate(['name' => 'required|string|unique:tasks']);
        $data['created_by_id'] = $request->user()->id;

        $labels = $request->input('labels');

        $task = new Task();
        $task->fill($data);
        $task->save();
        $task->labels()->attach($labels);

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
        $labels = Label::all();

        $usersByIds = Utils::groupByIdWithName($users);
        $statusesByIds = Utils::groupByIdWithName($taskStatuses);
        $labelsById = Utils::groupByIdWithName($labels);

        return view('tasks.edit', compact('task', 'usersByIds', 'statusesByIds', 'labelsById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $data['name'] = $request->validate(['name' => 'required|string|unique:tasks,name,' . $task->id]);
        $labels = $request->input('labels');

        $task->fill($data);
        $task->labels()->sync($labels);
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
        flash(__('flash.taskDeleted'))->success();
        $task->labels()->detach();
        $task->delete();
        return redirect()
        ->route('tasks.index');
    }
}
