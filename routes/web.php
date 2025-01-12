<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Toggle;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/home', function () {
//     return view('main');
// })->name('home');
Route::get('/users', [UserController::class, 'index']);
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

Route::get('/home', function () {
    return view('main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/monitoring', function () {
    return view('monitoring.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/control', function () {
        return view('control');
    })->name('control');
});

Route::post('/toggle/{lampId}', function (Request $request, $lampId) {
    $toggle = Toggle::updateOrCreate(
        ['lamp_id' => $lampId],
        ['state' => $request->state]
    );

    return response()->json(['success' => true, 'state' => $toggle->state]);
});
Route::get('/toggle/{lampId}', function ($lampId) {
    $toggle = Toggle::where('lamp_id', $lampId)->first();
    return response()->json(['state' => $toggle ? $toggle->state : false]);
});

require __DIR__.'/auth.php';
