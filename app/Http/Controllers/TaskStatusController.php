<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use App\Http\Requests\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function index(Request $request)
    {
        $taskStatuses = TaskStatus::paginate(15);

        return view('taskStatuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskStatus $taskStatus)
    {
        return view('taskStatuses.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStatusRequest $request)
    {
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.statusCreated'))->success();

        return to_route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $data = $request->validated();

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.statusChanged'))->success();

        return to_route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('flash.statusNotDeleted'))->warning();
            return back();
        }

        flash(__('flash.statusDeleted'))->success();
        $taskStatus->delete();

        return to_route('task_statuses.index');
    }
}
