<?php
    namespace App\Http\Controllers;

interface ILogin {
    public function setName($name);
    public function setPassword($password);
    public function autentificar($con);
    public function toString();
}

?>