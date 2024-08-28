<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\LabelRequest;

class LabelController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(15);

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Label $label)
    {
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash(__('flash.labelCreated'))->success();

        return to_route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash(__('flash.labelChanged'))->success();

        return to_route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('flash.labelNotDeleted'))->warning();
            return back();
        }

        $label->delete();
        flash(__('flash.labelDeleted'))->success();

        return to_route('labels.index');
    }
}
