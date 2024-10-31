<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    //

    public function index(){
        $tarefas = Tarefa::orderBy('ordem')->get();
        return response()->json($tarefas);
    }
}
