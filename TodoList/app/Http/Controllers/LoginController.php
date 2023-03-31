<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check()){
            return redirect()->intended(route(name: 'user.private')); 
        }

        $formsFields = $request->only(['email', 'password']);

        if(Auth::attempt($formsFields)){
            return redirect()->intended(route(name: 'user.private'));
        }

       return redirect(route(name: 'user.login'))->withErrors([
            'email' => 'Не удалось авторизироваться'
       ]);
    }
}
