<?php
require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client(
    'mongodb+srv://root:a@localhost/test?retryWrites=true&w=majority'
);

$collection = $client->demo->beers;

$result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

echo "Inserted with Object ID '{$result->getInsertedId()}'";
?>
