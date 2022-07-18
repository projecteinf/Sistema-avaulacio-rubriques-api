<?php
    // namespace App\Http\Controllers;
    // require_once __DIR__."/implementacio/MongoDb.php";
    

    $con = new MongoDB\Driver\Manager("mongodb://root:a@127.0.0.1:27017");
    if($con) {
        $list = new MongoDB\Driver\Command(["listCollections"=>1]);
        $res = $con->executeCommand("admin",$list);
        var_dump($list);
    }
    else echo "ERROR";
    // $filter = ['user'=>'acalvo'];
    // $options = [];
    // $query = new MongoDB\Driver\Query($filter,$options);
    // $rows = $con->connexio->executeQuery('rubrica.usuaris',$query);
    // $result = "";
    // foreach ($rows as $r) {
    //     var_dump($r);
    // }



?>
