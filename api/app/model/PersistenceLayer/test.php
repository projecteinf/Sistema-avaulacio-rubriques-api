<?php
    namespace App\Http\Controllers;
    // require_once __DIR__."/implementacio/MongoDb.php";
    require_once __DIR__."/../../Utilities/Utilities.php";

    $con = new \MongoDB\Driver\Manager("mongodb://professor:p@docker_mongo_1:27017/admin");
    if($con) {
        try {
            $filter = ['user' => 'acalvo','password' => 'a'];
            $options = [];
            //$options = ['projection'=>['user' => 1,'password' => 1 ]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);
            //echo count($rows->toArray());
            foreach ($rows as $row) {
                 var_dump($row);
                 var_dump(\Utilities::guidv4());
            }
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
