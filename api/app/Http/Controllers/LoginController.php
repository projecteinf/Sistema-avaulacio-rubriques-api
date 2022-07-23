<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Login.php";
require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/implementacio/MongoDb.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Token.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Params.php";
require_once $_ENV["APP_ROOT"]."/app/Utilities/Utilities.php";
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
        $data = \Token::jwt(\Params::SECRET_KEY,\Params::ISSUER_CLAIM,\Params::AUDIENCE_CLAIM);
        $data->id=\Utilities::guidv4();
        $data->name=$this->login->getName();
        
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
        //$authHeader = 'Bearer {"message":"Successful","jwt":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJET0NLRVJfUEhQXzEiLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE2NTg1MTU5MDgsIm5iZiI6MTY1ODUxNjAwOCwiZXhwIjoxNjU4NTE5NTA4LCJkYXRhIjp7ImlkIjoiNjJkN2VhYjU1OTdmMThmODE0N2JiMGE4IiwibmFtZSI6ImFjYWx2byJ9fQ.tDpwhtZ5GTwl6ooToFXnaPm1fkmoxK4Yl67707IWBtp_pb-C3OdSf8VKoDEJy4hm22WSsCmiTY9yI6fIhP8gPQ","name":"acalvo","expireAt":1658519508}';        
        $dades = \Token::fromBearer($authHeader);
        $jwt = $dades->jwt;
        $this->login->setName($dades->name);
        
        if($jwt){
        
            try {
                $decoded = \Firebase\JWT\JWT::decode($jwt,  new \Firebase\JWT\Key($secret_key, 'HS512'));
                //if (!$this->login->sameName($decoded->data->name)) return null;

                // Access is granted. Add code of the operation here 
    
                return json_encode(array(
                    "name" => $this->login->getName(),
                    "message" => "Access granted:",
                    "error" => "No error"
                ));
    
            }catch (Exception $e){
    
                http_response_code(401);
        
                echo json_encode(array(
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
