<?php

namespace App\Controllers;


use \Lib\Token;

class AuthsController extends Controller {
    public function login() {
        if(auth()->user())  return response()->redirect('/dashboard');
        response()->render('login', [
            '_token' => Token::generate('login_form')
        ]);
    }

    public function register() {
        // response()->render('register');
        auth()->register([
            'username' => 'admin',
            'password' => 'admin123',
            'credits' => 1000,
            'created_at' => time()
        ]);
    }

    public function logout() {
        if(auth()->user()) auth()->logout();
        return response()->redirect('/auth/login');
    }

    public function authenticate() {
        if(request()->isAjax() === false) return response()->redirect('/auth/login');
        
        $body = request()->body();
        if(!Token::check($body['_token'] ?? '', 'login_form')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid CSRF token',
                '_token' => Token::generate('login_form')
            ]);
        }
        $username = $body["username"] ?? '';
        $password = $body["password"] ?? '';
        // var_dump($username, $password); exit;
        if (auth()->login(["username" => $username, "password" => $password])) {
            return response()->json([
                'success' => true
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password',
                '_token' => Token::generate('login_form')
            ]);
        }
    }
}
