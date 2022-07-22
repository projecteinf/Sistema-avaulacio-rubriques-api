<?php
    namespace App\Http\Controllers;

    require_once __DIR__."/../../../vendor/php-jwt/JWT.php";
    require_once __DIR__."/../../../vendor/php-jwt/Key.php";
    require_once __DIR__."/../../../vendor/php-jwt/ExpiredException.php";
    require_once __DIR__."/../../../vendor/php-jwt/BeforeValidException.php";
    require_once __DIR__."/../../Utilities/Token.php";

   
    $secret_key = "YOUR_SECRET_KEY";
    $authHeader = 'Bearer {"message":"Successful","jwt":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJET0NLRVJfUEhQXzEiLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE2NTg0Mjk4MjYsIm5iZiI6MTY1ODQyOTgzNiwiZXhwIjoxNjU4NDI5ODMyLCJkYXRhIjp7ImlkIjoiNjJkN2VhYjU1OTdmMThmODE0N2JiMGE4IiwibmFtZSI6ImFjYWx2byJ9fQ.xNovxW0WO-wzD_enOFokFStLaBpTin1O0V_cYapOQHaYBrVsp3vEtgONAux8bvKd9do3y35BXaFZFGKOP4EMSw","name":"acalvo","expireAt":1658429832}';

    $arr = explode(" ", $authHeader);

    $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJET0NLRVJfUEhQXzEiLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE2NTg1MDIyMjMsIm5iZiI6MTY1ODUwMjMyMywiZXhwIjoxNjU4NTAyODIzLCJkYXRhIjp7ImlkIjoiNjJkN2VhYjU1OTdmMThmODE0N2JiMGE4IiwibmFtZSI6ImFjYWx2byJ9fQ.RJqKQ7wirZCquG0GJHUCMVV1nQ4xVMckH2oS_SxUMUu03J07sc_4NyXAaOIdmH5xIgIDeKy_3ejF_L2fvl8msg";
    $json = json_decode($arr[1]);
    echo "JWT: {$json->jwt}";
    
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
