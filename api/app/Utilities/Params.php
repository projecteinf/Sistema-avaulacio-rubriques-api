<?php
// https://datatracker.ietf.org/doc/html/rfc7519#section-4
    class Params {
        const SECRET_KEY = "YOUR_SECRET_KEY"; // No hauria d'estar aquí!
        const ISSUER_CLAIM = "DOCKER_PHP_1";
        const AUDIENCE_CLAIM = "USER"; 
        const SEGONS_DURADA_TOKEN = 300; // Segons
        const PRORROGA_TOKEN = 50; // % . Si TEMPS_TRANSCORREGUT>=SEGONS_DURADA_TOKEN*PRORROGA_TOKEN/100 => ProrrogarToken()
}