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
}
