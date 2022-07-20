<?php
    namespace App\Http\Controllers;
    session_start();
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
                 $uid=\Utilities::guidv4();
                 //$uid="ValorFix";
                 //if (!isset($_SERVER[$uid])) $_SERVER[$uid] = $uid;
                 //else $_SERVER[$uid] = $uid."OKKKKKKKKKKKKKK";
                 
            }
            var_dump(session_id());
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
