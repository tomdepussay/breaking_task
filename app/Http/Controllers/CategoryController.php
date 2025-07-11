<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        return view('category/create', [
            'project' => $project
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
            'project_id' =>'required|integer',
        ]);

        $category = new Category;
        $category->project_id = $validated['project_id'];
        $category->name = $validated['name'];
        $category->save();

        return response()->json([
            'message' => 'Catégorie ajoutée avec succès'
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
        $category_id = $request->category_id;
        $category = Category::find($category_id);

        return view('category/edit', [
            'category' => $category
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

        $category = Category::find($request->category_id);
        $category->name = $validated['name'];
        $category->save();

        return response()->json([
            'message' => 'Catégorie modifiée avec succès'
        ]);
    }

    public function delete(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::find($category_id);

        return view('category/delete', [
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->category_id);

        if($category->tasks()->count() > 0){
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas supprimer cette catégorie car elle contient des tâches'
            ]);
        }

        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Catégorie supprimée avec succès'
        ]);
    }
}
