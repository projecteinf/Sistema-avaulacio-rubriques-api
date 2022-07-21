<?php
class Token {
    public String $secret_key;
    public String $issuer_claim; // this can be the servername
    public String $audience_claim;
    public Int $issuedat_claim; // issued at
    public Int $notbefore_claim; //not before in seconds
    public Int $expire_claim; // expire time in seconds
    public String $id;
    public String $firstName;
    public String $lastName;
    public String $email;

    public function __construct($secret_key,$issuer_claim,$audience_claim,$id) {
        $this->secret_key = $secret_key;
        $this->issuer_claim = $issuer_claim;
        $this->audience_claim = $audience_claim;
        $this->issuedat_claim = time();
        $this->notbefore_claim = $this->issuedat_claim + 10;
        $this->expire_claim = $this->issuedat_claim + 6;
        $this->id=$id;
    }
}