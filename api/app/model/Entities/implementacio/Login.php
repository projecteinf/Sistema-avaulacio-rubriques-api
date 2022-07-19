<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";
    
    class Login implements ILogin {
        private string $name;
        private string $password;

        public function setName($name) { $this->name = $name;}
        public function setPassword($password) { $this->password = $password;}

        public function  autentificar($con) {
            $filter = [];
            $options = ['projection'=>['user' => 1,'password' => 1 ]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);
            
            $result = "";
            //$filter = ['user'=>'acalvo'];
            //$options = [ 'projection' => ['_id' => 0 ]];
            //$query = new MongoDB\Driver\Query($filter,$options);
            //$rows = $con->executeQuery('rubrica.usuaris',$query); 
            
            foreach ($rows as $r) {
                $result = $r;
            }
            return $result;
        }

        public function toString() {
            return "Usuari: {$this->name} Password: {$this->password}";
        }
    }