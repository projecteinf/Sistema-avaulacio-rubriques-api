<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/IRubrica.php";

    class Rubrica implements IRubrica {
        
        public function getRubrica($con,$curs) { 
            $filter = ['curs'=>$curs];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
           
            $rows = $con->executeQuery('rubrica.capacitats',$query);            
            return $rows->toArray();
        }

        public function save($con,$data) {
            $info = new \MongoDB\Driver\BulkWrite();
            $info->insert(json_decode($data));

            $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 100);
            $result = $con->executeBulkWrite('rubrica.gbarris',$info,$writeConcern);
            return $result;
        }



        public static function minimitzar($jsonData,$jsonKey) {
            //var_dump($jsonKey);
            $capacitatsClau = json_decode($jsonData)->capacitatsClau;
            $key = json_decode($jsonKey)->key;
            gettype($key);
            $valCC = array();

             foreach($capacitatsClau as $index => $capacitatClau) {
                $nota = null;
                if (isset($capacitatClau->nota)) $nota = $capacitatClau->nota;
                $obj = (object) [
                    'nom' => $capacitatClau->nom,
                    'nota' => $nota 
                ];
                $valCC[$index]=$obj;
            }  
            
            $result = '{key:'.$jsonKey.",valoracio:".json_encode($valCC) .'}';
            return ["response" => $result];
            
        }

    }