<?php

namespace App\Http\Controllers;
use App\Models\Project;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            //'creator_id' => auth()->id(),
        ]);

        // Ajouter le créateur en tant que membre du projet
    // $project->members()->attach(auth()->id());

        return response()->json([
            'message' => 'Projet créé avec succès',
            'project' => $project,
        ], 201);
    }

}
