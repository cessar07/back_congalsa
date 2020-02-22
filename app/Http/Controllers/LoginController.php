<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{
    public function postLogin(Request $r){
    	$r->validate([
    		'email' => 'required|email',
    		'password' => 'required'
    	] , [
    		'email.required'    => 'Ingresa un email',
    		'email.email'       => 'Ingresa un email valido',
    		'password.required' => 'Ingresa la contraseña'
    	]);

    	$credentials = $r->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/index');
        }else{
        	return back()->with('error' , 'Datos incorrectos');
        }
    }

    public function adminLogout(){
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('/admin/login');
    }
}
