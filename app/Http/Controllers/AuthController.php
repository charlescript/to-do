<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index(Request $request){
        if (Auth::check()){
            return redirect()->route('home');
        }
        return view('login');
    }

    public function login_action(Request $request){
        // dd($request);

        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

       if( Auth::attempt($validator) ) {
            return redirect()->route('home');
       }else {
        return view('login');
       }
        //dd($validator);
    }

    public function register(Request $request){

        $isLoggedIn = Auth::check();
        if($isLoggedIn){
            return redirect()->route('home');
        }

        return view('register');
    }


    public function register_action(Request $request){
        //dd($request);

        /************************************
        Regras para registro
         x O usuário tem que ter um nome
         x O email tem que ser único na tabela users
         x Todos os campos são REQUIRED3
         x Password tem que ter no minimo 6 caracteres
        ***********************************************/
        // Validadores
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->only('name','email','password');

        $data['password'] = Hash::make($data['password']);
        // $userCreated = User::create($data);

        User::create($data);
        return redirect(route('login'));
    }


    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
