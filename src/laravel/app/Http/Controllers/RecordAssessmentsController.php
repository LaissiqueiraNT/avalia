<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Models\RecordAssessment;

class RecordAssessmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplines = Discipline::all();
        $testTypes = RecordAssessment::TEST_TYPES;
        $assessments = RecordAssessment::with('discipline')->get();

        return view('record-assessments.index-record-assessments', compact('disciplines', 'testTypes', 'assessments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $disciplines = Discipline::all();
        $testTypes = RecordAssessment::TEST_TYPES;

        return view('record-assessments.crud-record-assessments', compact('disciplines', 'testTypes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'discipline_id' => 'required',
            'type_test' => 'required',
            'primary_date' => 'required|date',
            'end_date' => 'required|date',
            'hours' => 'nullable|integer|min:1|max:8',
        ]);

        RecordAssessment::create([
            'discipline_id' => $request->discipline_id,
            'type_test' => $request->type_test,
            'primary_date' => $request->primary_date,
            'end_date' => $request->end_date,
            'hours' => $request->hours ?? 2, // Padrão 2 horas se não informado
        ]);

        return redirect()->route('record-assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Avaliação criada com sucesso!',
            ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $edit = RecordAssessment::find($id);
    $disciplines = Discipline::all();
    $testTypes = RecordAssessment::TEST_TYPES;

    return view('record-assessments.crud-record-assessments', compact(
        'edit',
        'disciplines',
        'testTypes'
    ));
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'discipline_id' => 'required',
            'type_test' => 'required',
            'primary_date' => 'required|date',
            'end_date' => 'required|date',
            'hours' => 'nullable|integer|min:1|max:8',
        ]);

        $recordAssessment = RecordAssessment::find($id);
        $recordAssessment->update([
            'discipline_id' => $request->discipline_id,
            'type_test' => $request->type_test,
            'primary_date' => $request->primary_date,
            'end_date' => $request->end_date,
            'hours' => $request->hours ?? 2,
        ]);

        return redirect()->route('record-assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Avaliação atualizada!',
            ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recordAssessment = RecordAssessment::findOrFail($id);
        $recordAssessment->delete();

        return redirect()->route('record-assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Avaliação excluída!',
                'text' => 'A avaliação foi removida com sucesso.'
            ]);
    }
}
