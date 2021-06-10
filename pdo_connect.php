<?php

// ----------[ connexion BDD via PDO ]---------- 

// on récupère les constantes 
include_once('constants.php');

try {
    $cnn = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8',
        USER,
        PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );
} catch (Exception $e) {
    echo $e->getMessage();
}
