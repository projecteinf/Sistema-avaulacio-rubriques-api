<?php
    require_once __DIR__."/../interfaces/ILogin.php";

    class Login implements ILogin {
        private $name, $password;

        public autentificar() {
            return true;
        }

        
    }