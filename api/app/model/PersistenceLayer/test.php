<?php
    namespace App\Http\Controllers;
    session_start();
    // require_once __DIR__."/implementacio/MongoDb.php";
    require_once __DIR__."/../../../vendor/php-jwt/JWT.php";
    require_once __DIR__."/../../Utilities/Token.php";

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
                 $data = new \Token("YOUR_SECRET_KEY","DOCKER_PHP_1","THE_AUDIENCE","62d7eab5597f18f8147bb0a8");
                 $data->firstname="alex";
                 $data->lastname="calvo";
                 $data->email="acalvo@boscdelacoma.cat";

                 $token = array(
                     "iss" => $data->issuer_claim,
                     "aud" => $data->audience_claim,
                     "iat" => $data->issuedat_claim,
                     "nbf" => $data->notbefore_claim,
                     "exp" => $data->expire_claim,
                     "data" => array(
                         "id" => $data->id,
                         "firstname" => $data->firstname,
                         "lastname" => $data->lastname,
                         "email" => $data->email
                 ));
         
                 http_response_code(200);
         
                 $jwt = \Firebase\JWT\JWT::encode($token, $data->secret_key, 'HS512');
                 echo json_encode(
                     array(
                         "message" => "Successful login.",
                         "jwt" => $jwt,
                         "email" => $data->email,
                         "expireAt" => $data->expire_claim
                     ));

                 
            }
            
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
