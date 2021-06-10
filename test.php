<?php

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('create_web_page.php');
// include_once('session_check.php');




// ----------[ génération de la page web ]---------- 
// définition des paramètres : 
$params = ["mega test QWERTY !!", "", ""];
// affichage de la page web paramétrée 
echo (createWebPage(...$params));
