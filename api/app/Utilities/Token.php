<?php
require_once $_ENV["APP_ROOT"]."/app/Utilities/Params.php";

class Token {
    public String $secret_key;
    public String $issuer_claim; // this can be the servername
    public String $audience_claim;
    public Int $issuedat_claim; // issued at
    public Int $notbefore_claim; //not before in seconds
    public Int $expire_claim; // expire time in seconds
    public String $id;
    public String $name;
    public String $jwt;

    public function __construct() {

    }

    public static function jwt($secret_key,$issuer_claim,$audience_claim) {
        $instance = new self();
        $instance->secret_key = $secret_key;
        $instance->issuer_claim = $issuer_claim;
        $instance->audience_claim = $audience_claim;
        $instance->issuedat_claim = time();
        $instance->notbefore_claim = $instance->issuedat_claim;
        $instance->expire_claim = $instance->issuedat_claim + Params::SEGONS_DURADA_TOKEN;
        return $instance;
    }

    public static function fromBearer( $bearer ) {
        $instance = new self();
        $arr = explode(" ", $bearer);
        $json = json_decode($arr[1]);
        $instance->jwt = $json->jwt;
        $instance->name = $json->name;
        return $instance;
    }
}