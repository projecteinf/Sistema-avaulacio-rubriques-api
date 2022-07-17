<?php
   namespace App\Http\Controllers;

   require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";

    class Login implements ILogin {
        private string $name;
        private string $password;

        // La classe depèn de la informació que se li envia!
        // No és una bona tècnica. Millor utilitzar setters individuals!
        /* public function inicialitzar($data) {
            $this->name=$data->usuari;
            $this->password=$data->password;
           //foreach ($data as $key => $value) $this->{$key} = $value;
        } */

        public function setName($name) { $this->name = $name;}
        public function setPassword($password) { $this->password = $password;}

        public function  autentificar(): bool {
            return true;
        }

        public function toString() {
            return "Usuari: {$this->name} Password: {$this->password}";
        }
    }