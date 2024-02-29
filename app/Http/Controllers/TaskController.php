<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::latest()->paginate(3);
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        // Validate
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // Add item
        Task::create($request->all());

        // Redirect to the view
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task): View
    {
        return view('edit', ['task' => $task]); // send the task to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task): RedirectResponse
    {
        // Validate
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // Update item
        $task->update($request->all());

        // Redirect to the view
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        $task->delete();
        // Redirect to the view
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente');
    }
}
