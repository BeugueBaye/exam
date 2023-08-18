<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReponseController; // Ajouter cette ligne pour importer le contrôleur de réponses

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/questions', [QuestionController::class, 'create']);

Route::get('/questions', [QuestionController::class, 'index']); // Utilisez la méthode 'index' pour récupérer les questions

Route::post('/questions/{id}/vote', [QuestionController::class, 'vote']);

Route::post('/questions/{id}/repondre', [ReponseController::class, 'ajouterReponse']);
Route::get('/questions/{id}/reponses', [ReponseController::class, 'getReponsesForQuestion']);

// routes/api.php
Route::post('/questions/{id}/increment-vu', [QuestionController::class, 'incrementVu']);

Route::get('/questions/{id}', [QuestionController::class, 'show']);

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/AddProduit', [ProduitController::class, 'AddProduit']);

Route::get('/produits', [ProduitController::class, 'getProduits']);
