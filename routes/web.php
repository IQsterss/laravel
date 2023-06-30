<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\LocationController;
use App\Models\Location;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/userstable', function () {
    $sortColumn = request()->query('sort_column', 'name');
    $sortOrder = request()->query('sort_order', 'asc');

    $users = User::orderBy($sortColumn, $sortOrder)->get();

    return view('userstable', compact('users', 'sortColumn', 'sortOrder'));
})->middleware(['auth', 'verified'])->name('userstable');


Route::resource("/locations", LocationController::class)->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
