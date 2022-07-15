<?php
interface ILogin {
    function __construct($json);
    public function  autentificar(): bool;
}

?>