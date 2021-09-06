<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    //
    public function login(Request $req){
        $user = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://localhost:8081/api/auth/login', [
            'email' => $req->email,
            'password' => $req->password
        ]); 
        $error = $user['message'];
        if(!$user->failed() || $user['error'] == false){
            session()->put('token', $user->json()['data']['token']);
            session()->put('user_id', $user->json()['data']['user']['id']);
            return redirect()->route('index');
        }
        return view('login', compact('error'))->withError("Não foi possivel logar 😢{$error}");
    }
    public function logout(){
        Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://localhost:8081/api/auth/logout', ['token' => session()->get('token')]);
        session()->forget('token');
        return redirect()->route('login');

    }
    public function register(Request $req){
        $result = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://localhost:8081/api/auth/register', [
            'email' => $req->email,
            'password' => $req->password,
            'name' => $req->name
        ]);
        if(!$result->failed() || !$result['errors']){
            session()->put('token', $result['data']['token']);
            return redirect()->route('index');
        }
        $errorList = json_encode($result['errors']);
        $error = "{$result['message']} \n {$errorList}";
        return view('register', compact('error'));
    }   
}
