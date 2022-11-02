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


/*
    Per activar/desactivar debug api/vendor/laravel/lumen-framework/config/app.php 
    'debug' => (bool) env('APP_DEBUG', false) // Desactivar
    'debug' => (bool) env('APP_DEBUG', true) // Activar
*/

class TestController extends Controller
{
    private Login $login;

    public function __construct() {
        $this->login = new Login();
    }

    private function inicialitzarLogin($dada) {
        $this->login->setName($dada->usuari);
        $this->login->setPassword($dada->password);
    }

    public function test(Request $request) {
        $postdata = file_get_contents("php://input");
        $this->inicialitzarLogin(json_decode($postdata,false));
        $passwordhash1='mb';
        if(password_verify($passwordhash1,$this->login->getPassword())) return "OK";
        else return "NOK";
    }

}