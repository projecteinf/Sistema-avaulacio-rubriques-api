<?php 
    require __DIR__ . "/controller/login/LoginController.php";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    var_dump($uri);
    $uri = explode( '/', $uri );

    var_dump(PHP_URL_PATH);
    var_dump($uri);
    $objFeedController = new LoginController();
    $strMethodName = 'getDataAction';
    var_dump($objFeedController->{$strMethodName}());

?>