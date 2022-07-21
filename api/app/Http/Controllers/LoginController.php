<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Login.php";
require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/implementacio/MongoDb.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Token.php";
require_once $_ENV["APP_ROOT"]."/vendor/php-jwt/JWT.php";

use MongoDb;

class LoginController extends Controller
{
    private Login $login;
    private MongoDb $con;

    public function __construct() {
        $this->login = new Login();
        $this->con = new MongoDb();
    }

    private function cors() {
        // Allow from any origin - ORIGINAL
        /* if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Token");
            header("Access-Control-Request-Headers: Content-Type");
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
        } */

        // header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        // header('Access-Control-Allow-Credentials: true');
        // header('Access-Control-Allow-Methods: HEAD, DELETE, POST, PUT, GET, OPTIONS');
        // header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        // header('Access-Control-Expose-Headers: Authorization');
        // header("Authorization: *");

    }

    private function inicialitzarLogin($dada) {
        $this->login->setName($dada->usuari);
        $this->login->setPassword($dada->password);
    }
    private function inicialitzarToken($data) {
        return array(
            "iss" => $data->issuer_claim,
            "aud" => $data->audience_claim,
            "iat" => $data->issuedat_claim,
            "nbf" => $data->notbefore_claim,
            "exp" => $data->expire_claim,
            "data" => array(
                "id" => $data->id,
                "firstname" => $data->firstname,
                "lastname" => $data->lastname,
                "email" => $data->email
            ));
    }
    private function generarJWT() {  // https://www.techiediaries.com/php-jwt-authentication-tutorial/
        $data = new \Token("YOUR_SECRET_KEY","DOCKER_PHP_1","THE_AUDIENCE","62d7eab5597f18f8147bb0a8");
        $data->firstname="alex";
        $data->lastname="calvo";
        $data->email="acalvo@boscdelacoma.cat";

        $token = $this->inicialitzarToken($data);

        http_response_code(200);

        $jwt = \Firebase\JWT\JWT::encode($token, $data->secret_key, 'HS512');
        return json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $data->email,
                "expireAt" => $data->expire_claim
            ));
    }
    private function validarUsuari() {
        // header("Access-Control-Allow-Origin: *");
        // header("Content-Type: application/json; charset=UTF-8");
        // header("Access-Control-Allow-Methods: POST");
        // header("Access-Control-Max-Age: 3600");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        // $secret_key = "YOUR_SECRET_KEY";
        // $jwt = null;
        
        // $data = json_decode(file_get_contents("php://input"));
        // if (!isset($_SERVER['HTTP_AUTHORIZATION'])) return "NOT SET";
        // else return $_SERVER['HTTP_AUTHORIZATION'];
        return "ok";
    }

    public function index() {
        $this->cors();
        return ['response' =>
            [
                //$this->validarUsuari()
                $_SERVER
            ]
        ];

    }

    

    // Exemple crida: http://localhost:8080/api/login
    public function login(Request $request) {
        $this->cors();
        $postdata = file_get_contents("php://input");
        
        $this->inicialitzarLogin(json_decode($postdata,false));
        if ($this->login->autentificar($this->con->connexio)==1) return ['response' => [$this->generarJWT()]];
    }
}
