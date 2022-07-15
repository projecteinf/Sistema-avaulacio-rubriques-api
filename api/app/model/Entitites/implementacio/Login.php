<?php
    require_once __DIR__."/../interfaces/ILogin.php";

    class Login implements ILogin {
        private string $name;
        private string $password;

        function __construct($json) { 
           // $this->$name = $json['Usuari'];
           // $this->$password = $json['Password'];
         }

        public function  autentificar(): bool {
            return true;
        }

        
    }