<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Column;
use App\Models\Priority;
use App\Models\Category;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_column = $request->query('id');
        $id_project = $request->query('project_id');

        $columns = Column::where('project_id', $id_project)->get();
        $priorities = Priority::where('project_id', $id_project)->get();
        $categories = Category::where('project_id', $id_project)->get();

        return view('task/create', [
            'id_column' => $id_column,
            'name' => "Nouvelle tâche",
            'id_project' => $id_project,
            'columns' => $columns,
            'priorities' => $priorities,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Put the task on last position of the column
        $lastTask = Task::where('column_id', $request->input('column_id'))
                        ->orderBy('order', 'desc')
                        ->first();
        $order = $lastTask ? $lastTask->order + 1 : 0;
        $request->merge(['order' => $order]);

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'deadline_at' => 'nullable|date',
            'column_id' => 'required|exists:columns,id',
            'priority_id' => 'nullable|exists:priorities,id',
            'category_id' => 'nullable|exists:categories,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Create a new task
        $task = Task::create(array_merge($validated, [
            'created_by' => auth()->id(),
        ]));

        // Redirect to the task list or show page
        return redirect()->route('projects.list', ['id' => $request->input('project_id')])
                         ->with('success', 'Tâche créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}