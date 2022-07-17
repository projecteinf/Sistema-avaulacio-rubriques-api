<?php
    // namespace App\Http\Controllers;
    require_once __DIR__."/implementacio/MongoDb.php";
    

    $con = new MongoDb();
    var_dump($con->connexio); 

    

?>
