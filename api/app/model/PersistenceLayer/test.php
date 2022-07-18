<?php
    // namespace App\Http\Controllers;
    // require_once __DIR__."/implementacio/MongoDb.php";
    

    $con = new MongoDB\Driver\Manager("mongodb://root:a@127.0.0.1:27017/rubrica");
    if($con) {
        try {
            $bulk = new MongodDB\Driver\BulkWrite;
            $bulk->insertOne(['nom' => 'TestUsuari']);
            $con->executeBulkWrite('rutina.usuaris',$bulk);
        } catch (Trowable $e) {
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
