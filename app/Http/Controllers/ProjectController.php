<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Column;
use App\Models\Priority;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Liste des projets de l'utilisateur connecté
     */
    public function index()
    {
        $projects = Auth::user()->projects;

        return view('project/index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Ajout du projet en base de données
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Créer un nouveau projet
        $project = new Project;
        $project->name = $validated['name'];
        $project->owner_id = Auth::id();
        $project->save();

        // Lier le projet à l'utilisateur créateur dans la table pivot
        $project->users()->attach(Auth::id());

        $todo = new Column;
        $todo->name = 'À faire';
        $todo->order = 1;
        $todo->project_id = $project->id;
        $todo->save();

        $current = new Column;
        $current->name = 'En cours';
        $current->order = 2;
        $current->project_id = $project->id;
        $current->begin_column = true;
        $current->save();

        $done = new Column;
        $done->name = 'Fait';
        $done->order = 3;
        $done->project_id = $project->id;
        $done->end_column = true;
        $done->save();

        $dropped = new Column;
        $dropped->name = 'Annulé';
        $dropped->order = 4;
        $dropped->project_id = $project->id;
        $dropped->end_column = true;
        $dropped->save();

        // Créer 3 prioritées par défaut
        $priorities = ['Basse', 'Normal', 'Urgent'];
        foreach ($priorities as $priorityName) {
            $priority = new Priority;
            $priority->name = $priorityName;
            $priority->project_id = $project->id;
            $priority->save();
        }

        // Créer 3 catégories par défaut
        $categories = ['Résolution de bugs', 'Ajout de fonctionnalité', 'Design'];
        foreach ($categories as $categoryName) {
            $category = new Category;
            $category->name = $categoryName;
            $category->project_id = $project->id;
            $category->save();
        }

        return response()->json([
            'message' => 'Projet ajouté avec succès',
            'project' => $project,
        ]);
    }

    /**
     * Affichage du projet
     */
    public function show($id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        return view('project.show', [
            'project' => $project,
        ]);
    }

    /**
     * Affichage du formulaire de modification d'un projet
     */
    public function edit(Request $request)
    {
        $id = $request->id;

        $project = Project::find($id);

        return view('project/edit', [
            'project' => $project,
        ]);
    }

    /**
     * Mise à jour du projet en base de données
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
            'project' => $project,
        ]);
    }

    /**
     * Affichage de la confirmation de suppression d'un projet
     */
    public function delete(Request $request)
    {
        $id = $request->id;

        $project = Project::find($id);

        return view('project/delete', [
            'project' => $project,
        ]);
    }

    /**
     * Suppression du projet en base de données
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $project = Project::find($id);
        $project->delete();

        return response()->json([
            'message' => 'Projet supprimé avec succès',
        ]);
    }

    /**
     * Affichage de la confirmation pour quitter un projet
     */
    public function leave(Request $request)
    {
        $id = $request->project_id;

        $project = Project::find($id);

        return view('project/leave', [
            'project' => $project,
        ]);
    }

    /**
     * Quitter un projet
     */
    public function quit(Request $request)
    {
        $project_id = $request->project_id;
        $project = Project::find($project_id);

        $project->users()->detach(Auth::id());

        return response()->json([
            'message' => 'Vous avez quitté le projet',
        ]);
    }

    /*
    * Affichage des paramètres d'un projet
    */
    public function parameters($id)
    {
        $project = Project::find($id);

        return view('project/parameters', [
            'project' => $project,
        ]);
    }

    /**
     * Affichage des utilisateurs d'un projet
     */
    public function users(Request $request)
    {
        $id = $request->project_id;
        $project = Project::find($id);

        return view('project/parameters/tabs/users/users', [
            'project' => $project,
            'users' => $project->users,
        ]);
    }

    /**
     * Affichage de la recherche d'utilisateur pour une collaboration
     */
    public function searchUsers(Request $request)
    {
        $search = $request->search;
        $projectId = $request->project_id;
        $project = Project::find($projectId);

        $users = User::where(function ($query) use ($search) {
            $query->where('firstname', 'like', '%'.$search.'%')
                ->orWhere('lastname', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        })
            ->whereNotIn('id', $project->users->pluck('id'))
            ->whereNot('id', Auth::id())
            ->get();

        return view('project/parameters/tabs/users/search', [
            'users' => $users,
        ]);
    }

    /**
     * Ajout d'un utilisateur à un projet
     */
    public function storeUsers(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'integer',
            'user_id' => 'integer',
        ]);

        $project = Project::find($validated['project_id']);
        $user = User::find($validated['user_id']);
        $project->users()->attach($user);

        return response()->json([
            'message' => 'Utilisateur ajouté avec succès',
        ]);
    }

    /**
     * Affichage de la confirmation de suppression d'un utilisateur d'un projet
     */
    public function deleteUsers(Request $request)
    {
        $user_id = $request->user_id;
        $project_id = $request->project_id;

        $user = User::find($user_id);
        $project = Project::find($project_id);

        return view('project/parameters/tabs/users/delete', [
            'user' => $user,
            'project' => $project,
        ]);
    }

    /**
     * Suppression d'un utilisateur d'un projet
     */
    public function destroyUsers(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'integer',
            'user_id' => 'integer',
        ]);

        $project = Project::find($validated['project_id']);
        $user = User::find($validated['user_id']);
        $project->users()->detach($user);

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ]);
    }
}
