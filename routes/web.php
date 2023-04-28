<?php
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\HomeController as AdminHomecontroller;
use App\Http\Controllers\Guest\HomeController as GuestHomecontroller;

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ! Controller per le rotte home.

Route::get('/', [AdminHomecontroller::class, 'index']);
Route::get('/', [GuestHomecontroller::class, 'index']);
Route::get('/home',[ProjectController::class,'index'])->middleware('auth')->name('home');
// stabilisco chi controlla questa rotta e come si chiama la funzione preposta


// Route::get('/projects/{project:slug}',[ProjectController::class,'show'])->middleware('auth')->name('custom.show');

// ? le rotte seguenti sono inserite in un group che assegnera' elementi comuni come prefisso inizio del name ecc

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function(){

// ! Controller per i projects
Route::get('/projects/trash',[ProjectController::class, 'trash'])->name('projects.trash');

Route::put('/projects/{project}/restore',[ProjectController::class, 'restore'])->name('projects.restore');

Route::delete('/projects/{project}/force-delete',[ProjectController::class, 'forceDelete'])->name('projects.force-delete');

Route::resource('projects', ProjectController::class)
->parameters(['projects' => 'project:slug']); 


// ! Controller per le types
Route::resource('types', TypeController::class);

});


// ! Controller per le technologies
Route::get('/admin/technologies/index',[TechnologyController::class, 'index'])->name('admin.technologies.index');


// ! Controller per l'auth
Route::middleware('auth')
// tutte le rotte di questo gruppo hanno come prefisso profile e gli do prefix()
    ->prefix('profile')
    // tutti i nomi delle rotte di questo gruppo iniziano con profile quindi do 
    ->name('profile.')
    // group va sempre per ultimo
    ->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';