<?php

namespace App\Http\Controllers;

use App\Models\compra;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosCompras = compra::All();
        $contador = $dadosCompras->count();

        return 'Compras: '.$contador.$dadosCompras.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosCompras = $request->All();
        $validarDados = Validator::make($dadosCompras,[
            'valortotal' => 'required',
            'quantidade' => 'required',
            'id_planta' => 'required',
            'id_cliente' => 'required',
            'id_funcinario' => 'required'
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $comprasCadastrar = compra::create($dadosCompras);
        if($comprasCadastrar){

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
        $compra = compra::find($id);

        if($compra){

            return 'compra localizada'.$compra.response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'compra não localizada'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosCompras = $request->All();
        $validarDados = Validator::make($dadosCompras,[
            'valortotal' => 'required',
            'quantidade' => 'required',
            'id_planta' => 'required|exists:plantas,id',
            'id_cliente' => 'required|exists:clientes,id',
            'id_funcinario' => 'required|exists:funcionarios,id'

        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $compra = compra::find($id);
        $compra->valortotal = $dadosCompras['valortotal'];
        $compra->quantidade = $dadosCompras['quantidade'];
        $compra->id_planta = $dadosCompras['id_planta'];
        $compra->id_cliente = $dadosCompras['id_cliente'];
        $compra->id_funcinario = $dadosCompras['id_funcinario'];

        $retorno = $compra->save();

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
        $dadosCompras = compra::find($id);

        if($dadosCompras->delete()){
            return 'A compra foi deletado com sucesso!!'.response()->json([],Response::HTTP_NO_CONTENT);
        } 

        return 'A compra não foi deletado'.response()->json([],Response::HTTP_NO_CONTENT);
    }
}
