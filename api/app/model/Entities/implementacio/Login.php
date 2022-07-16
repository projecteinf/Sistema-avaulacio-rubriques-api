<?php
    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";

    class Login implements ILogin {
        private string $name;
        private string $password;


        public function inicialitzar($data) {
           // foreach ($data as $key => $value) $this->{$key} = $value;

        }

        public function  autentificar(): bool {
            return true;
        }

        
    }