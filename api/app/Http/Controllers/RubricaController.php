<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/implementacio/MongoDb.php";
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
        return $this->rubrica->getRubrica($this->con->connexio,$curs);
    }
}
