<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index() {
        return ['response' =>
            [
                'id' => 1,
                'user' => 'Usuari exemple',
                'password' => 'Password exemple'
            ]
        ];

    }

    // Exemple crida: http://localhost:8080/api/login

    public function  login(Request $request) {
        return ['response' =>
            [
                'id' => 2,
                'user' => 'login '.var_dump($request->input('clau')), // recuperem camp clau del fitxer JSON. Cal modificar
                'password' => 'Password login'
            ]
        ];
    }
}
