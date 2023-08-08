<?php

use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\IdentityController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PasswordGeneratorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------------------------------------------- */

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


// Protected routes for the authenticated user's own records
Route::middleware('auth:api')->group(function () {

    // route for getting all records (logins, cards, and identities) with a single API call
    Route::get('vault/all', [UserController::class, 'userRecords']);
    Route::get('vault/search', [UserController::class, 'userRecords']);

    //route for  generate a random password based on the user's options
    Route::post('/password/generate', [PasswordGeneratorController::class, 'generate']);

    // routes for card records
    Route::get('vault/card/all', [CardController::class, 'userCards']);
    Route::post('vault/card/create', [CardController::class, 'create']);
    Route::post('vault/card/update/{id}', [CardController::class, 'update']);
    Route::delete('vault/card/delete/{id}', [CardController::class, 'destroy']);

    // routes for identity records
    Route::get('vault/identity/all', [IdentityController::class, 'userIdentities']);
    Route::post('vault/identity/create', [IdentityController::class, 'create']);
    Route::post('vault/identity/update/{id}', [IdentityController::class, 'update']);
    Route::delete('vault/identity/delete/{id}', [IdentityController::class, 'destroy']);
    
    // routes for login records
    Route::get('vault/login/all', [LoginController::class, 'userLogins']);
    Route::post('vault/login/create', [LoginController::class, 'create']);
    Route::post('vault/login/update/{id}', [LoginController::class, 'update']);
    Route::delete('vault/login/delete/{id}', [LoginController::class, 'destroy']);


});