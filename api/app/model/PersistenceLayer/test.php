<?php
    // namespace App\Http\Controllers;
    // require_once __DIR__."/implementacio/MongoDb.php";
    

    $con = new MongoDB\Driver\Manager("mongodb://admin:password@docker_mongo_1:27017/admin");
    if($con) {
        try {
            $filter = [];
            $options = ['projection'=>['user' => 1,'password' => 1 ]];
            $query = new MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);
            foreach ($rows as $row) {
                var_dump($row);
            }
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


        //$filter = [];$options = [];
        //$query = new MongoDB\Driver\Query($filter,$options);
        //$rows = $con->executeQuery('rubrica.usuaris',$query);
        //$rows = $con->connexio->executeQuery('rubrica.usuaris',$query);
        //$list = new MongoDB\Driver\Command(["listCollections"=>1]);
        //$res = $con->executeCommand("admin",$list);
        var_dump($con);
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
