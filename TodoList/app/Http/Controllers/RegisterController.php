<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
        public function save(Request $request){

            if(Auth::check()){
                return redirect(route(name: 'user.private'));
            }

        $validateFields = $request->validate([

            'email' => 'required|email',
            'password' => 'required'

        ]);


        if(User::where('email', $validateFields['email'])->exists()){
           return redirect(route(name:'user.registration'))->withErrors([
                'email' => 'Пользователь с данным email уже зарегестрирован'
            ]);
        }
        $user = User::create($validateFields);
        if($user){
            Auth::login($user);
            return redirect(route(name:'user.private'));
        }

        return redirect(route(name:'user.login'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
}

