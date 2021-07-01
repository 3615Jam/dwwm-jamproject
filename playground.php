<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
// on récupère les activités du user connecté
try {
    $qry = 'SELECT * FROM act a 
            JOIN usr_act ua ON a.id = ua.act_id 
            JOIN usr u ON u.id = ua.usr_id
            WHERE u.mail = ?;';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $res->execute(array($mail));
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// on parcours le résultat de la requête ligne à ligne 
$row = $res->fetchAll();
// var_dump($row);

$usr_act = [];
$html = "";
foreach ($row as $key => $val) {
    $bar .= '
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="' . $row[$key]['name'] . '" value="' . $row[$key]['name'] . '">
            <label class="form-check-label" for="' . $row[$key]['name'] . '">' . $row[$key]['name'] . '</label>
        </div>';
    array_push($usr_act, $row[$key]['content']);
}
// var_dump($usr_act);







// ----------[ génération de la page web ]---------- 
$pg_menu = '
<div>
    <div class="fixed-bottom">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Mes Activités</h5>
                <span class="text-white">' . $bar . '</span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
</div>';

$test = '
<div>

<ul id="sortable">
  ' . $usr_act[0] . $usr_act[1] . $usr_act[2] . '
</ul>

</div>
';

$jqueryui = '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';

// 1) définition des paramètres

// titre principal de la page
$page_title = "Aire de jeux";

// contenu de la balise main ( = corps de page)
$main_content = $pg_menu . '<div id="playground">' . $test . '</div>' . $jqueryui . '';

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
