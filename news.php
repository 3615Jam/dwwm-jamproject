<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');

// ----------[ génération de la page web ]---------- 
// définition des paramètres 
$params = ["Actualités", "", "<div>blah blah blah</div>"];

// affichage de la page web paramétrée 
echo (createWebPage(...$params));
