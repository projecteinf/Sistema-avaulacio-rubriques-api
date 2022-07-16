<?php
    require_once __DIR__."/implementacio/MongoDb.php";
    
    MongoDb::connectar();
    var_dump(MongoDb::$connexio); 

    

?>
