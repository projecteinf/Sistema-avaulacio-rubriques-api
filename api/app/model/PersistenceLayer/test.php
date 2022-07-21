<?php
    namespace App\Http\Controllers;
    session_start();
    // require_once __DIR__."/implementacio/MongoDb.php";
    require_once __DIR__."/../../../vendor/php-jwt/JWT.php";

    $con = new \MongoDB\Driver\Manager("mongodb://professor:p@docker_mongo_1:27017/admin");
    if($con) {
        try {
            $filter = ['user' => 'acalvo','password' => 'a'];
            $options = [];
            //$options = ['projection'=>['user' => 1,'password' => 1 ]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);
            //echo count($rows->toArray());
            foreach ($rows as $row) {
                 var_dump($row);
                 
                 $secret_key = "YOUR_SECRET_KEY";
                 $issuer_claim = "THE_ISSUER"; // this can be the servername
                 $audience_claim = "THE_AUDIENCE";
                 $issuedat_claim = time(); // issued at
                 $notbefore_claim = $issuedat_claim + 10; //not before in seconds
                 $expire_claim = $issuedat_claim + 60; // expire time in seconds
                 $id="62d7eab5597f18f8147bb0a8";
                 $firstname="alex";
                 $lastname="calvo";
                 $email="acalvo@boscdelacoma.cat";

                 $token = array(
                     "iss" => $issuer_claim,
                     "aud" => $audience_claim,
                     "iat" => $issuedat_claim,
                     "nbf" => $notbefore_claim,
                     "exp" => $expire_claim,
                     "data" => array(
                         "id" => $id,
                         "firstname" => $firstname,
                         "lastname" => $lastname,
                         "email" => $email
                 ));
         
                 http_response_code(200);
         
                 $jwt = \Firebase\JWT\JWT::encode($token, $secret_key, 'HS512');
                 echo json_encode(
                     array(
                         "message" => "Successful login.",
                         "jwt" => $jwt,
                         "email" => $email,
                         "expireAt" => $expire_claim
                     ));

                 
            }
            var_dump(session_id());
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
