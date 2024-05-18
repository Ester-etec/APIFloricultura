<?php

use App\Http\Controllers\PlantaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CompraController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

Route::get('/', function () {return 'APi de floricultura'.Response()->json(['Sucesso'=>true]);});

//Plantas
Route::get('/plantas',[PlantaController::class,'index']);
Route::post('/plantas',[PlantaController::class,'store']);
Route::delete('/plantas/{id}',[PlantaController::class,'destroy']);
Route::put('/plantas/{id}',[PlantaController::class,'update']);
Route::get('/plantas/{id}',[PlantaController::class,'show']);


//Clientes
Route::get('/clientes',[ClienteController::class,'index']);
Route::post('/clientes',[ClienteController::class,'store']);
Route::delete('/clientes/{id}',[ClienteController::class,'destroy']);
Route::put('/clientes/{id}',[ClienteController::class,'update']);
Route::get('/clientes/{id}',[ClienteController::class,'show']);


//Funcionarios
Route::get('/funcionarios',[FuncionarioController::class,'index']);
Route::post('/funcionarios',[FuncionarioController::class,'store']);
Route::delete('/funcionarios/{id}',[FuncionarioController::class,'destroy']);
Route::put('/funcionarios/{id}',[FuncionarioController::class,'update']);
Route::get('/funcionarios/{id}',[FuncionarioController::class,'show']);


//Compras
Route::get('/compras',[CompraController::class,'index']);
Route::post('/compras',[CompraController::class,'store']);
Route::delete('/compras/{id}',[CompraController::class,'destroy']);
Route::put('/compras/{id}',[CompraController::class,'update']);
Route::get('/compras/{id}',[CompraController::class,'show']);