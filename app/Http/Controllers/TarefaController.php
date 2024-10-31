<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class TarefaController extends Controller
{
    //

    public function index(){
        $tarefas = Tarefa::orderBy('ordem')->get();
        return response()->json($tarefas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|unique:tarefas,nome',
            'custo' => 'required|numeric',
            'data_limite' => 'required|date'
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.unique' => 'Este nome já está em uso.',
            'custo.required' => 'O campo custo é obrigatório.',
            'custo.numeric' => 'O campo custo deve ser numérico.',
            'data_limite.required' => 'O campo data limite é obrigatório.',
            'data_limite.date' => 'O campo data limite deve ser uma data válida.'
        ]);

        if ($validator->fails()) {
            $erros = $validator->errors();
            $errosFormatados = [];

            foreach ($erros->toArray() as $campo => $mensagens) {
                $errosFormatados[$campo] = implode(', ', $mensagens);
            }

            return response()->json($errosFormatados,400);
        }
        $ordem = Tarefa::max('ordem') + 1;

        $tarefaCreated = Tarefa::create([
            "nome" => $request->nome,
            "custo" => $request->custo,
            "data_limite" => $request->data_limite,
            "ordem" => $ordem
        ]);

        return response()->json($tarefaCreated, 201);
    }

    public function destroy($id)
    {
        $tarefa = Tarefa::find($id);

        if (!$tarefa) {
            return response()->json([
                "error" => "A tarefa em questão não existe"
            ], 404);
        }

        $ordemTarefa = $tarefa->ordem;
        $tarefa->delete();

        Tarefa::where("ordem", ">", $ordemTarefa)->decrement("ordem");

        return response()->json([
            "message" => "Tarefa deletada e ordens atualizadas com sucesso"
        ], 200);
    }

}
