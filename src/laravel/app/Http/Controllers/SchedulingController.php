<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\Scheduling;

class SchedulingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        $disciplines = Discipline::all();
        return view('scheduling.index', compact('courses', 'disciplines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $disciplines = Discipline::all();
        return view('scheduling.create', compact('courses', 'disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'discipline_id' => 'required|integer',
            'date' => 'required|date',
        ]);

        try {
            // Criar novo agendamento
            $scheduling = new Scheduling();
            $scheduling->user_id = auth()->id(); // ID do professor logado
            $scheduling->discipline_id = $request->discipline_id;
            
            // Combinar data com um horário padrão (será definido pelo aluno depois)
            $scheduling->scheduling = $request->date . ' 00:00:00';
            
            // Campos opcionais que podem ser preenchidos pelo aluno depois
            $scheduling->address = null;
            $scheduling->neighborhood = null;
            
            $scheduling->save();

            return redirect()->route('scheduling.index')
                ->with('success', 'Avaliação registrada com sucesso! Os alunos poderão escolher horário e local.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao registrar avaliação: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Scheduling $scheduling)
    {
        return view('scheduling.show', compact('scheduling'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scheduling $scheduling)
    {
        $courses = Course::all();
        $disciplines = Discipline::all();
        return view('scheduling.edit', compact('scheduling', 'courses', 'disciplines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scheduling $scheduling)
    {
        // Validação será implementada depois
        $scheduling->update($request->all());

        return redirect()->route('scheduling.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scheduling $scheduling)
    {
        $scheduling->delete();
        return redirect()->route('scheduling.index')->with('success', 'Avaliação removida com sucesso!');
    }
}