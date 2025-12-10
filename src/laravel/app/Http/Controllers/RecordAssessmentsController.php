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
            'hours' => 'nullable|integer|min:0|max:8',
            'minutes' => 'nullable|integer|min:0|max:59',
        ]);

        // Verificar se já existe uma avaliação igual (mesma disciplina e tipo)
        $exists = RecordAssessment::where('discipline_id', $request->discipline_id)
            ->where('type_test', $request->type_test)
            ->where('primary_date', $request->primary_date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('alert', [
                    'icon' => 'warning',
                    'title' => 'Avaliação duplicada',
                    'text' => 'Já existe uma avaliação deste tipo para esta disciplina nesta data.'
                ])
                ->withInput();
        }

        // Calcular duração total em minutos
        $totalMinutes = ($request->hours ?? 0) * 60 + ($request->minutes ?? 0);
        
        // Se não informou nada, padrão de 2 horas (120 minutos)
        if ($totalMinutes == 0) {
            $totalMinutes = 120;
        }

        RecordAssessment::create([
            'discipline_id' => $request->discipline_id,
            'type_test' => $request->type_test,
            'primary_date' => $request->primary_date,
            'end_date' => $request->end_date,
            'hours' => $totalMinutes,
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
            'hours' => 'nullable|integer|min:0|max:8',
            'minutes' => 'nullable|integer|min:0|max:59',
        ]);

        // Calcular duração total em minutos
        $totalMinutes = ($request->hours ?? 0) * 60 + ($request->minutes ?? 0);
        
        // Se não informou nada, padrão de 2 horas (120 minutos)
        if ($totalMinutes == 0) {
            $totalMinutes = 120;
        }

        $recordAssessment = RecordAssessment::find($id);
        $recordAssessment->update([
            'discipline_id' => $request->discipline_id,
            'type_test' => $request->type_test,
            'primary_date' => $request->primary_date,
            'end_date' => $request->end_date,
            'hours' => $totalMinutes,
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
        
        // Remover todos os agendamentos vinculados ESPECIFICAMENTE a esta avaliação
        $deletedSchedulings = \DB::table('schedulings')
            ->where('assessment_id', $id)
            ->delete();
        
        // Remover todos os resultados relacionados a esses agendamentos específicos
        // (já foram deletados em cascade pela foreign key)
        
        // Remover a avaliação (isso também vai deletar schedulings via cascade)
        $recordAssessment->delete();

        return redirect()->route('record-assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Avaliação excluída!',
                'text' => "A avaliação foi removida com sucesso. {$deletedSchedulings} agendamento(s) de alunos também foram removidos."
            ]);
    }
}
