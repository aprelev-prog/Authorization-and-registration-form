<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'index');

Route::name('user.')->group(function(){
    Route::view('/private', 'private')->middleware(middleware:'auth')->name(name:'private');

    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route(name:'user.private'));
        }
        return view(view:'login');
    })->name(name:'login');
    
    Route::post('login', [LoginController::class, 'login']);

    Route::get('/logout',function(){
        Auth::logout();
        return redirect(to:'/');
    })->name(name:'logout');

    
    Route::get('/registration',function(){
        if(Auth::check()){
            return redirect(route(name:'user.private'));
        }
        return view(view: 'registration');
    })->name(name: 'registration');

    Route::post('/registration', [RegisterController::class, 'save']);
});