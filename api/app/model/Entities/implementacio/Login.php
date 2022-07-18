<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";

    class Login implements ILogin {
        private string $name;
        private string $password;

        public function setName($name) { $this->name = $name;}
        public function setPassword($password) { $this->password = $password;}

        public function  autentificar($con): bool {
            $filter
            $rows = $con->executeQuery($filter,$options);
        }

        public function toString() {
            return "Usuari: {$this->name} Password: {$this->password}";
        }
    }