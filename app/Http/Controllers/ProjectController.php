<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Column;
use App\Models\Priority;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Return list of project
     */
    public function index()
    {
        $projects = Auth::user()->projects;
            
        return view("project/index", [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Créer un nouveau projet
        $project = new Project();
        $project->name = $validated['name'];
        $project->owner_id = Auth::id();
        $project->save();

        // Lier le projet à l'utilisateur créateur dans la table pivot
        $project->users()->attach(Auth::id());

        $todo = new Column();
        $todo->name = "À faire";
        $todo->order = 1;
        $todo->project_id = $project->id;
        $todo->save();

        $current = new Column();
        $current->name = "En cours";
        $current->order = 2;
        $current->project_id = $project->id;
        $current->begin_column = true;
        $current->save();

        $done = new Column();
        $done->name = "Fait";
        $done->order = 3;
        $done->project_id = $project->id;
        $done->end_column = true;
        $done->save();

        $dropped = new Column();
        $dropped->name = "Annulé";
        $dropped->order = 4;
        $dropped->project_id = $project->id;
        $dropped->end_column = true;
        $dropped->save();

        // Créer 3 prioritées par défaut
        $priorities = ['Basse', 'Normal', 'Urgent'];
        foreach ($priorities as $priorityName) {
            $priority = new Priority();
            $priority->name = $priorityName;
            $priority->project_id = $project->id;
            $priority->save();
        }

        // Créer 3 catégories par défaut
        $categories = ['Résolution de bugs', 'Ajout de fonctionnalité', 'Design'];
        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->name = $categoryName;
            $category->project_id = $project->id;
            $category->save();
        }

        return response()->json([
            'message' => 'Projet ajouté avec succès',
            'project' => $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);
        
        return view('project/show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        
        $project = Project::find($id);
        return view('project/edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'id' => 'integer',
            'name' => 'required|string|max:255',
        ]);

        // Créer un nouveau projet
        $project = Project::find($validated['id']);
        $project->name = $validated['name'];
        $project->save();

        return response()->json([
            'message' => 'Projet modifié avec succès',
            'project' => $project
        ]);
    }

    /**
     * Show the confirm for delete the specified resource.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        
        $project = Project::find($id);
        return view('project/delete', [
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $project = Project::find($id);
        $project->delete();
        return response()->json([
            'message' => 'Projet supprimé avec succès'
        ]);
    }
}