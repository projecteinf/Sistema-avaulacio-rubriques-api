<?php
  
    if (isset($_ENV["APP_ROOT"]))
        require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/interfaces/IConnexio.php";
    else
        require_once __DIR__."/../interfaces/IConnexio.php";

    class MongoDb implements IConnexio {
        public $connexio;
        public function __construct() {
            $this->connexio = new MongoDB\Driver\Manager("mongodb://professor:p@docker_mongo_1:27017/admin");
        }

    }
?>