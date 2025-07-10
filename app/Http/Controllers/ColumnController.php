<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;
use App\Models\Project;

class ColumnController extends Controller
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
        return view('column/create', [
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
            'begin_column' => 'required|boolean',
            'end_column' => 'required|boolean',
            'project_id' =>'required|integer',
        ]);

        $project = Project::find($request->project_id);
        $last_order = $project->columns()->max('order');
        $last_order++;

        $column = new Column;
        $column->project_id = $request->project_id;
        $column->name = $request->name;
        $column->begin_column = $request->begin_column;
        $column->end_column = $request->end_column;
        $column->order = $last_order;
        $column->save();

        return response()->json([
            'message' => 'Colonne ajoutée avec succès'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $column = Column::find($id);

        return view('column/show', [
            'column' => $column,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_column = $request->column_id;
        $column = Column::find($id_column);

        return view('column/edit', [
            'column' => $column
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
            'begin_column' => 'required|boolean',
            'end_column' => 'required|boolean',
        ]);

        $column = Column::find($request->column_id);
        $column->name = $request->name;
        $column->begin_column = $request->begin_column;
        $column->end_column = $request->end_column;
        $column->save();

        return response()->json([
            'message' => 'Colonne modifiée avec succès'
        ]);
    }

    public function delete(Request $request)
    {
        $id_column = $request->column_id;
        $column = Column::find($id_column);

        return view('column/delete', [
            'column' => $column
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $column = Column::find($request->column_id);

        if($column->tasks()->count() > 0){
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas supprimer cette colonne car elle contient des tâches'
            ]);
        }

        $column->delete();
        return response()->json([
            'success' => true,
            'message' => 'Colonne supprimée avec succès'
        ]);
    }

    public function sort(Request $request)
    {
        $column_id = $request->column_id;
        $direction = $request->direction;

        $column = Column::find($column_id);

        $newOrder = $column->order + ($direction == 'up' ? -1 : 1);

        $otherColumn = Column::where('order', $newOrder)->first();
        if($otherColumn){
            $otherColumn->order = $column->order;
            $otherColumn->save();
            $column->order = $newOrder;
            $column->save();
        } else {
            return response()->json([
               'success' => false,
               'message' => 'Impossible de déplacer cette colonne'
            ]);
        }

        return response()->json([
           'success' => true,
           'message' => 'Colonne déplacée avec succès'
        ]);
    }
}
