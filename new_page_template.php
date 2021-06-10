<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');

// ----------[ génération de la page web ]---------- 
// 1) définition des paramètres

// titre principal de la page
$page_title = "";

// contenu de la balise main ( = corps de page)
$main_content = '';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index, 1 = playground, 2 = activities, 3 = help, 4 = account
$active = [false, false, false, false, false];

// [optionnel] fichier de script externe 
$script = '';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
