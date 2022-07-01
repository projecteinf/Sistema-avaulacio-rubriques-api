<?php
$client = new MongoDB\Client(
    'mongodb+srv://root:a@localhost/test?retryWrites=true&w=majority'
);
$db = $client->test;