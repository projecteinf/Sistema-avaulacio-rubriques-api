<?php
    namespace App\Http\Controllers;
    // require_once __DIR__."/implementacio/MongoDb.php";
    

    $con = new \MongoDB\Driver\Manager("mongodb://admin:password@docker_mongo_1:27017/admin");
    if($con) {
        try {
            $filter = ['user' => 'acalvo'];
            $options = [];
            //$options = ['projection'=>['user' => 1,'password' => 1 ]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);
            //echo count($rows->toArray());
            foreach ($rows as $row) {
                 var_dump($row);
            }
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
