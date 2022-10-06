<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/IRubrica.php";

    class Rubrica implements IRubrica {
        
        public function getRubrica($con,$curs) { 
            $cursCodi = explode("=",$curs)[1];
            $filter = ['curs'=>$cursCodi];
            var_dump($curs); echo "<br>";
            var_dump($filter);
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
           
            $rows = $con->executeQuery('rubrica.capacitats',$query);            
            return $rows->toArray();
        }

    }