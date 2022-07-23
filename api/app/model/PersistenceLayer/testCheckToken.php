<?php
    namespace App\Http\Controllers;

    require_once __DIR__."/../../../vendor/php-jwt/JWT.php";
    require_once __DIR__."/../../../vendor/php-jwt/Key.php";
    require_once __DIR__."/../../../vendor/php-jwt/ExpiredException.php";
    require_once __DIR__."/../../../vendor/php-jwt/BeforeValidException.php";
    require_once __DIR__."/../../Utilities/Token.php";

   
    $secret_key = "YOUR_SECRET_KEY";
    $authHeader = 'Bearer {"message":"Successful","jwt":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJET0NLRVJfUEhQXzEiLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE2NTg1NjgzOTAsIm5iZiI6MTY1ODU2ODQ5MCwiZXhwIjoxNjU4NTcxOTkwLCJkYXRhIjp7ImlkIjoiMSIsIm5hbWUiOiJhY2Fsdm8ifX0.0GSLdXhIQPxjrTOQxCoj3x6e294Zg3PGoWElYt2NzJcyALj8iPw_zFxWfWnvqJWbGKMmC39emn4PzOMIWHHyJA","name":"acalvo","expireAt":1658571990}';
    $jwt = \Token::fromBearer($authHeader)->jwt;
    echo $jwt;
    //$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJET0NLRVJfUEhQXzEiLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE2NTg1MTM0MDIsIm5iZiI6MTY1ODUxNDQwMiwiZXhwIjoxNjU4NTE3MDAyLCJkYXRhIjp7ImlkIjoiNjJkN2VhYjU1OTdmMThmODE0N2JiMGE4IiwibmFtZSI6ImFjYWx2byJ9fQ.DlzFyI8iNh1fCnpLbMg71TmEEstzjsg3kB6Y3HHr2Ueye-hjRDTPb9aE0qD8zz5_eqCBxS7RNkW1JBIs8mAOYw";
    
    if($jwt){

        try {
            $decoded = \Firebase\JWT\JWT::decode($jwt,  new \Firebase\JWT\Key($secret_key, 'HS512'));

            // Access is granted. Add code of the operation here 

            echo json_encode(array(
                "message" => "Access granted:",
                "error" => "No error"
            ));

        }catch (Exception $e){

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

    }

?>
