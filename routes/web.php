<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group( function () {
   Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard'); 
   Route::get('/all/user', [UserController::class, 'AllUser'])->name('user.index'); 
   Route::get('/add/user', [UserController::class, 'AddUser'])->name('add.user'); 
   Route::post('/store/user', [UserController::class, 'StoreUser'])->name('store.user'); 
});
Route::middleware(['auth', 'verified'])->group( function () {
   Route::get('all/role', [RoleController::class, 'index'])->name('role'); 
   Route::get('add/role', [RoleController::class, 'AddRole'])->name('add.role'); 
   Route::post('store/role', [RoleController::class, 'Store'])->name('store.role'); 
   Route::get('edit/role/{id}', [RoleController::class, 'EditRole'])->name('edit.role'); 
   Route::post('update/role/{id}', [RoleController::class, 'UpdateRole'])->name('update.role'); 
   Route::get('delete/role/{id}', [RoleController::class, 'Destroy'])->name('delete.role'); 
   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
