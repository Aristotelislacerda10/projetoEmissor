<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){

        return view('login.index');
    }

    public function entrar(Request $req){

        $dados = $req->all();

        if(Auth::attempt(['email'=>$dados['email'],'password'=>$dados['senha']])){

            return redirect()->route('site.home');
        }

           return redirect()->route('login.index');
    }

    public function sair()
    {
        Auth::logout();
        return view('login.index');
    }
}
