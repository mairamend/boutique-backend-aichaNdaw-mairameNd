<?php

use App\Http\Controllers\Web\CategorieController;
use App\Http\Controllers\Web\ProduitController;
use App\Http\Controllers\Web\UtilisateurController;
use App\Http\Controllers\Web\ProfilController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AcheteurController;
Route::get('/', function () {
    return view('home');
})->name('accueil');;
// route pour categories
Route::middleware(['auth','role:gestionnaire,admin'])->group(function(){
    Route::resource('categories',CategorieController::class)->except(['index','show'])
    ->parameters(['categories' => 'categorie']);;
});
Route::middleware(['auth','role:employe,gestionnaire,admin'])->group(function(){
    Route::resource('categories',CategorieController::class)->only(['index','show'])
    ->parameters(['categories' => 'categorie']);;
});


// routes pour produits 

    // la liste des produits et le detail d'un produit  etant accessible sans connexion on a pas besoin du middleware
Route::middleware(['auth','role:gestionnaire,admin'])->group(function(){
    Route::resource('produits',ProduitController::class)->except(['index','show']);
});    
 Route::resource('produits',ProduitController::class)->only(['index','show']);
Route::middleware(['auth','role:gestionnaire,admin'])->group(function(){
    Route::resource('acheteurs',AcheteurController::class)->except(['index','show']);
});
Route::middleware(['auth','role:employe,gestionnaire,admin'])->group(function(){
    Route::resource('acheteurs',AcheteurController::class)->only(['index','show']);
    Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])->name('acheteurs.acheter');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('utilisateurs', UtilisateurController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login']);
});
Route::post('/deconnexion', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

