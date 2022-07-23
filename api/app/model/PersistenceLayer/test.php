<?php
    namespace App\Http\Controllers;

    // require_once __DIR__."/implementacio/MongoDb.php";
    require_once __DIR__."/../../../vendor/php-jwt/JWT.php";
    require_once __DIR__."/../../Utilities/Token.php";
    require_once __DIR__."/../../Utilities/Params.php";

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
                 $data = \Token::jwt(\Params::SECRET_KEY,\Params::ISSUER_CLAIM,\Params::AUDIENCE_CLAIM);
                 $data->id="1";
                 $data->name="acalvo";

                 $token = array(
                     "iss" => $data->issuer_claim,
                     "aud" => $data->audience_claim,
                     "iat" => $data->issuedat_claim,
                     "nbf" => $data->notbefore_claim,
                     "exp" => $data->expire_claim,
                     "data" => array(
                         "id" => $data->id,
                         "name" => $data->name,
                 ));
         
                // http_response_code(200);
         
                 $jwt = \Firebase\JWT\JWT::encode($token, $data->secret_key, 'HS512');
                 echo json_encode(
                     array(
                         "message" => "Successful login.",
                         "jwt" => $jwt,
                         "name" => $data->name,
                         "expireAt" => $data->expire_claim
                     ));

                 
            }
            
        } catch (Excption $e) {
            echo "Error {$e->getMessage()}";
        }


    }
    else echo "ERROR";
   

?>
