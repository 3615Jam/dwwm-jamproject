<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
try {
    $qry = 'SELECT * FROM users WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $res->execute(array($mail));
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// on parcours le résultat de la requête ligne à ligne 
$row = $res->fetch();


// ----------[ génération de la page web ]---------- 
$pg_menu = '
<div>
</div>';

// 1) définition des paramètres

// titre principal de la page
$page_title = "Aire de jeux";

// contenu de la balise main ( = corps de page)
$main_content = '<div id="playground"></div>';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index.php, 1 = playground.php, 2 = activities.php, 3 = help.php
$active = [false, true, false, false];

// [optionnel] fichier de script externe 
$script = 'playground.js';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
