<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Login.php";
require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/implementacio/MongoDb.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Utilities.php";

use MongoDb;

class LoginController extends Controller
{
    private Login $login;
    private MongoDb $con;

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

    private function inicialitzarLogin($dada) {
        $this->login->setName($dada->usuari);
        $this->login->setPassword($dada->password);
    }

    public function __construct() {
        $this->login = new Login();
        $this->con = new MongoDb();
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
        
        $this->inicialitzarLogin(json_decode($postdata,false));
        $uid = "";
        if ($this->login->autentificar($this->con->connexio)==1) {
            $uid = \Utilities::guidv4();
        }
        return ['response' =>
            [
                $uid
            ]
        ];
           
    }

    
}
