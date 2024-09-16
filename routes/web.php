<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AppController::class, 'home'])->name('home');
Route::get('/record', [AppController::class, 'record'])->name('record');
Route::get('/report', [AppController::class, 'reportDemo'])->name('reportDemo');
Route::get('/report/{id}', [AppController::class, 'report'])->name('report');

Route::post('/record/{case_id}', [AppController::class, 'recordPost'])->name('recordPost');
Route::post('/finish/{case_id}', [AppController::class, 'finishCase'])->name('finishCase');

Route::get('/login', [AppController::class, 'login'])->name('login');
Route::get('/logout', [AppController::class, 'logout'])->name('logout');

Route::get('/pain/new', [AppController::class, 'newPain'])->name('newPain');
Route::get('/pain', [AppController::class, 'pain'])->name('pain');
Route::get('/symptoms', [AppController::class, 'symptoms'])->name('symptoms');
Route::get('/symptoms/select', [AppController::class, 'symptomsSelect'])->name('symptomsSelect');
Route::get('/received' , [AppController::class, 'received'])->name('received');
Route::get('/result' , [AppController::class, 'result'])->name('result');

Route::post('/pain', [AppController::class, 'painPost'])->name('painPost');
Route::post('/symptoms', [AppController::class, 'symptomsPost'])->name('symptomsPost');
Route::post('/symptoms/select', [AppController::class, 'symptomsSelectPost'])->name('symptomsSelectPost');
Route::post('/received', [AppController::class, 'receivedPost'])->name('receivedPost');
Route::post('/case', [AppController::class, 'caseSubmit'])->name('caseSubmit');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/user/{id}', [DashboardController::class, 'userShow'])->name('userShow');
    Route::get('/case/{id}', [DashboardController::class, 'caseShow'])->name('caseShow');
});


// Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';
