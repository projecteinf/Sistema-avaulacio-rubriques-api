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
require_once $_ENV["APP_ROOT"]."/app/model/Entities/implementacio/Rubrica.php";

use MongoDb;

class RubricaController extends Controller
{
    // Definir les rutes (get/post) a la carpeta routes fitxer web.php

    private MongoDb $con;
    private Rubrica $rubrica;

    public function __construct() {
        $this->rubrica = new Rubrica();
        $this->con = new MongoDb();
    }

    public function getRubrica($curs) {
        return $this->rubrica->getRubrica($this->con,$curs);
        //return $request->input('curs');
    }
}
