<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\Label;
use App\Models\TaskNotification;
use App\Helpers\Utils;
use App\Http\Requests\TaskRequest;
use App\Models\TaskComment;
use App\Services\TaskNotification\TaskNotificationService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', null);
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->latest()
            ->paginate(15);

        $statusesByIds = Utils::groupByIdWithName(TaskStatus::all());
        $usersByIds = Utils::groupByIdWithName(User::all());

        return view('tasks.index', compact('tasks', 'usersByIds', 'statusesByIds', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        $usersByIds = Utils::groupByIdWithName(User::all());
        $statusesByIds = Utils::groupByIdWithName(TaskStatus::all());
        $labelsById = Utils::groupByIdWithName(Label::where('system', false)->get());

        return view('tasks.create', compact('task', 'usersByIds', 'statusesByIds', 'labelsById'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $labels = $request->input('labels');

        $task->author()->associate($request->user());
        $task->fill($data);
        $task->save();
        $task->labels()->attach($labels);

        flash(__('flash.taskCreated'))->success();

        return to_route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Task $task, TaskComment $comment, TaskNotificationService $notif)
    {
        $usersByIds = Utils::groupByIdWithName(User::all());

        $notifications = $notif->retrieveWithDelete();

        return view('tasks.show', compact('task', 'comment', 'usersByIds', 'notifications'));
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
        $labels = $request->input('labels');

        $task->fill($data);
        $task->labels()->sync($labels);
        $task->save();

        flash(__('flash.taskUpdated'))->success();

        return to_route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        if ($request->user()->cannot('delete', $task)) {
            abort(403);
        }

        $task->labels()->detach();
        $task->notifications()->delete();

        foreach ($task->comments as $comment) {
            $comment->recipients()->detach();
        }
        $task->comments()->delete();

        $task->delete();

        flash(__('flash.taskDeleted'))->success();

        return to_route('tasks.index');
    }
}
