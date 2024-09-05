<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/firebase/update', [FirebaseController::class, 'update'])->name('firebase.update');