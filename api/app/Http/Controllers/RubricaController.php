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

    public function saveRubrica(Request $request) {
        $postdata = file_get_contents("php://input");
        $postkey = json_decode($postdata)->key;
        $postdata = json_decode($postdata)->data;        
        //$data = Rubrica::minimitzar($postdata,$postkey);
        
        return $this->rubrica->save($this->con->connexio,$postdata);
        
    }
}
