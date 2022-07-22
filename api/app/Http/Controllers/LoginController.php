<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Login.php";
require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/implementacio/MongoDb.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Token.php";
require_once $_ENV["APP_ROOT"]."/vendor/php-jwt/JWT.php";
require_once $_ENV["APP_ROOT"]."/vendor/php-jwt/Key.php";
require_once $_ENV["APP_ROOT"]."/vendor/php-jwt/ExpiredException.php";
require_once $_ENV["APP_ROOT"]."/vendor/php-jwt/BeforeValidException.php";


use MongoDb;

class LoginController extends Controller
{
    private Login $login;
    private MongoDb $con;

    public function __construct() {
        $this->login = new Login();
        $this->con = new MongoDb();
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
                "name" => $data->name
            ));
    }

    private function generarJWT() {  // https://www.techiediaries.com/php-jwt-authentication-tutorial/
        //$data = new \Token("YOUR_SECRET_KEY","DOCKER_PHP_1","THE_AUDIENCE","62d7eab5597f18f8147bb0a8");
        $data = \Token::jwt("YOUR_SECRET_KEY","DOCKER_PHP_1","THE_AUDIENCE","62d7eab5597f18f8147bb0a8");
        $data->name="acalvo";
        
        $token = $this->inicialitzarToken($data);

        http_response_code(200);

        $jwt = \Firebase\JWT\JWT::encode($token, $data->secret_key, 'HS512');
        return json_encode(
            array(
                "message" => "Successful",
                "jwt" => $jwt,
                "name" => $data->name,
                "expireAt" => $data->expire_claim
            ));
    }

    private function validarUsuari() {
        $secret_key = "YOUR_SECRET_KEY";
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $token = \Token::fromBearer($authHeader);
        return $token;

        if($jwt){
        
            try {
                
                $decoded = \Firebase\JWT\JWT::decode($jwt, $secret_key, array('HS512'));
                return "OK";
                // Access is granted. Add code of the operation here 
        
                return json_encode(array(
                    "message" => "Access granted:",
                    "error" => $e->getMessage()
                ));
        
            }catch (Exception $e){
        
                http_response_code(401);
            
                return json_encode(array(
                    "message" => "Access denied.",
                    "error" => $e->getMessage()
                ));
            }
        }

    }

    public function index() {
        return ['response' =>
            [
                $this->validarUsuari()
            ]
        ];

    }

    

    // Exemple crida: http://localhost:8080/api/login
    public function login(Request $request) {
        $postdata = file_get_contents("php://input");
        
        $this->inicialitzarLogin(json_decode($postdata,false));
        if ($this->login->autentificar($this->con->connexio)==1) return ['response' => [$this->generarJWT()]];
    }
}
