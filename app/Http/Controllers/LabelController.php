<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:labels',
            'description' => 'string',
        ]);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('flash.labelCreated'))->success();

        return redirect()
        ->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        abort(403);
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
    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:labels,name,' . $label->id,
            'description' => 'string',
        ]);

        $label->fill($data);
        $label->save();

        flash(__('flash.labelChanged'))->success();

        return redirect()
        ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if (count($label->tasks) !== 0) {
            flash(__('flash.labelNotDeleted'))->warning();
            return back();
        }
        $label->delete();
        flash(__('flash.labelDeleted'))->success();
        return redirect()
        ->route('labels.index');
    }
}
