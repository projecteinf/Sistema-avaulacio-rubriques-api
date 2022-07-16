<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// require_once "/api/app/model/Entities/implementacio/Login.php";
require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Login.php";

// require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";


class LoginController extends Controller
{

    private function cors() {
        
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

    public function login(Request $request) {
        $this->cors();
        
        $postdata = file_get_contents("php://input");
        $login = new Login();
        

        // $login = json_decode($postdata,false); 
        //$login->autentificar();

        return ['response' =>
            [
                json_decode($postdata,false)->id  
            ]
        ];
           
    }
}
