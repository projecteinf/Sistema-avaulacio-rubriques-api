<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private function cors() {
    
        // header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        // header('Access-Control-Max-Age: 1000');
        
        
        

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                //header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}, Content-Type, Authorization, X-Requested-With");
        
            exit(0);
        }
    }
    
    

    public function index() {
        $this->cors();
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
        $this->cors();
        /* return ['response' =>
            [
                'id' => 2,
                'user' => 'login ', //.var_dump($request->input('clau')), // recuperem camp clau del fitxer JSON. Cal modificar
                'password' => 'Password login'
            ]
        ]; */

        $postdata = file_get_contents("php://input");
        return ['response' =>
            [
                $postdata
            ]
        ];
           
    }
}
