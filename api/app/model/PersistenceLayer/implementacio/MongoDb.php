<?php
  require_once $_ENV["APP_ROOT"]."/app/model/PersistenceLayer/interfaces/IConnexio.php";
    class MongoDb { // implements IConnexio {
        public static $connexio;
        public static function connectar() {
            MongoDb::$connexio = new MongoDB\Driver\Manager("mongodb://root:a@localhost:27017");
        }
    }
?>