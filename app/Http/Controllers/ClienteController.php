<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosClientes = cliente::All();
        $contador = $dadosClientes->count();

        return 'Clientes: '.$contador.$dadosClientes.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosClientes = $request->All();
        $validarDados = Validator::make($dadosClientes,[
            'nome' => 'required',
            'email' => 'required',
            'tel' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $clientesCadastrar = cliente::create($dadosClientes);
        if($clientesCadastrar){

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
        $cliente = cliente::find($id);

        if($cliente){

            return 'cliente localizda'.$cliente.response()->json([],Response::HTTP_NO_CONTENT);
        } else {

            return 'cliente não localizda'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosClientes = $request->All();
        $validarDados = Validator::make($dadosClientes,[
            'nome' => 'required',
            'email' => 'required',
            'tel' => 'required',
        ]);
 
        if ($validarDados->fails()) {
            return 'Dados invalidos'.$validarDados->error(true). 500;
        }

        $cliente = cliente::find($id);
        $cliente->nome = $dadosClientes['nome'];
        $cliente->email = $dadosClientes['email'];
        $cliente->tel = $dadosClientes['tel'];


        $retorno = $cliente->save();

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
        $dadosClientes = cliente::find($id);

        if($dadosClientes->delete()){
            return 'O cliente foi deletado com sucesso!!'.response()->json([],Response::HTTP_NO_CONTENT);
        } 

        return 'O cliente não foi deletado'.response()->json([],Response::HTTP_NO_CONTENT);
    }
}
