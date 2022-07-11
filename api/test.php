<?php
    require_once __DIR__."/model/PersistenceLayer/implementacio/MongoDb.php";

    MongoDb::connectar();
    var_dump(MongoDb::$connexio);

    

?>
