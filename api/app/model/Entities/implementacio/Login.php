<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";
    
    class Login implements ILogin {
        private string $name;
        private string $password;

        public function setName($name) { $this->name = $name;}
        public function setPassword($password) { $this->password = $password;}

        public function  autentificar($con) {
            $filter = ['user' => $this->name,'password' => $this->password];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            return count($rows->toArray());
        }

        public function toString() {
            return "Usuari: {$this->name} Password: {$this->password}";
        }
    }