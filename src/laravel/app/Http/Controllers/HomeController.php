<?php

namespace App\Http\Controllers;

use App\Models\RecordAssessment;
use App\Models\User;
use App\Models\Scheduling;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
{
    $user = auth()->user();
    
    // Se for professor (type_user = 1), mostra dashboard com estatísticas
    if ($user->type_user == 1) {
        $totalAssessments = RecordAssessment::count();
        $totalStudents = User::where('type_user', 2)->count();
        $totalSchedulings = Scheduling::count();
        
        // Avaliações recentes
        $recentAssessments = RecordAssessment::with('discipline')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact('totalAssessments', 'totalStudents', 'totalSchedulings', 'recentAssessments'));
    }
    
    // Se for aluno (type_user = 2), mostra dashboard com provas agendadas
    if ($user->type_user == 2) {
        $mySchedulings = Scheduling::with(['discipline'])
            ->where('user_id', $user->id)
            ->orderBy('scheduling', 'asc')
            ->get();
        
        return view('student-dashboard', compact('mySchedulings'));
    }
    
    // Fallback
    return view('dashboard');
}
}
