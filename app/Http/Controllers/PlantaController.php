<?php

namespace App\Http\Controllers;

use App\Models\planta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class PlantaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosPlantas = planta::All();
        $contador = $dadosPlantas->count();

        return 'Plantas: '.$contador.$dadosPlantas.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosPlantas = $request->All();
        $validarDados = Validator::make($dadosPlantas,[
            'tipo' => 'required',
            'nome' => 'required',
            'valor' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $plantasCadastrar = planta::create($dadosPlantas);
        if($plantasCadastrar){

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
        $planta = planta::find($id);

        if($planta){

            return 'planta localizda'.$planta.response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'planta não localizda'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosPlantas = $request->All();
        $validarDados = Validator::make($dadosPlantas,[
            'tipo' => 'required',
            'nome' => 'required',
            'valor' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $planta = planta::find($id);
        $planta->tipo = $dadosPlantas['tipo'];
        $planta->nome = $dadosPlantas['nome'];
        $planta->valor = $dadosPlantas['valor '];


        $retorno = $planta->save();

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
        $dadosPlantas = planta::find($id);

        if($dadosPlantas->delete()){
            return 'A planta foi deletado com sucesso!!'.response()->json([],Response::HTTP_NO_CONTENT);
        } 

        return 'A planta não foi deletado'.response()->json([],Response::HTTP_NO_CONTENT);
    }
}
