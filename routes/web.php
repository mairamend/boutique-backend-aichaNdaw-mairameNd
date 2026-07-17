<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\Auth;
// Route::get('/test-role', function () {
//     return 'Accès autorisé ! Vous êtes : ' . auth()->user()->role;
// })->middleware(['auth', 'role:employe']);
// Route::get('/dev-login/{id}', function ($id) {
//     Auth::loginUsingId($id);
//     return 'Connecté avec l\'utilisateur #' . $id;
// });


