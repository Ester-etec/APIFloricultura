<?php

namespace App\Http\Controllers;

use App\Models\funcionario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosFuncionarios = funcionario::All();
        $contador = $dadosFuncionarios->count();

        return 'Funcionarios: '.$contador.$dadosFuncionarios.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosFuncionarios = $request->All();
        $validarDados = Validator::make($dadosFuncionarios,[
            'nome' => 'required',
            'email' => 'required',
            'funcao' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $funcionariosCadastrar = funcionario::create($dadosFuncionarios);
        if($funcionariosCadastrar){

            return 'Dados cadastrados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        } else{

            return 'Dados não cadastrados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $funcionario = funcionario::find($id);

        if($funcionario){

            return 'funcionario localizda'.$funcionario.response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'funcionario não localizda'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosFuncionarios = $request->All();
        $validarDados = Validator::make($dadosFuncionarios,[
            'nome' => 'required',
            'email' => 'required',
            'funcao' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $funcionario = funcionario::find($id);
        $funcionario->nome = $dadosFuncionarios['nome'];
        $funcionario->email = $dadosFuncionarios['email'];
        $funcionario->funcao = $dadosFuncionarios['funcao'];


        $retorno = $funcionario->save();

        if($retorno){

            return 'Dados atualizados com sucesso'.Response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'Dados não atualizados'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosFuncionarios = funcionario::find($id);

        if($dadosFuncionarios->delete()){
            return 'O funcionario foi deletado com sucesso!!'.response()->json([],Response::HTTP_NO_CONTENT);
        } 

        return 'O funcionario não foi deletado'.response()->json([],Response::HTTP_NO_CONTENT);
    }
}
