<?php
    $m = new MongoDB\Driver\Manager("mongodb://root:a@localhost:27017");
    echo "<h1>Test de connexio</h1>";
    var_dump($m)
?>
