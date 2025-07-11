<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Project;
use Illuminate\Http\Request;

class PriorityController extends Controller
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
        $id_project = $request->project_id;
        $project = Project::find($id_project);

        return view('priority/create', [
            'project' => $project,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|integer',
        ]);

        $priority = new Priority;
        $priority->project_id = $validated['project_id'];
        $priority->name = $validated['name'];
        $priority->save();

        return response()->json([
            'message' => 'Priorité ajoutée avec succès',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $priority_id = $request->priority_id;
        $priority = Priority::find($priority_id);

        return view('priority/edit', [
            'priority' => $priority,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $priority = Priority::find($request->priority_id);
        $priority->name = $validated['name'];
        $priority->save();

        return response()->json([
            'message' => 'Priorité modifiée avec succès',
        ]);
    }

    public function delete(Request $request)
    {
        $priority_id = $request->priority_id;
        $priority = Priority::find($priority_id);

        return view('priority/delete', [
            'priority' => $priority,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $priority = Priority::find($request->priority_id);

        if ($priority->tasks()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas supprimer cette priorité car elle contient des tâches',
            ]);
        }

        $priority->delete();

        return response()->json([
            'success' => true,
            'message' => 'Priorité supprimée avec succès',
        ]);
    }
}
