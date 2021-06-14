<?php

// ----------[ SCRIPT - PHP ]---------- 
// mise à jour des info perso du user depuis le formulaire de la page account.php

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// on récupère toutes les données envoyées par le formulaire 'post' et on échappe les caractères spéciaux HTML de chacune 
$params = [];
foreach ($_POST as $key => $val) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $params[] = htmlspecialchars($_POST[$key]);
    } else {
        $params[] = null;
    }
}
// var_dump($params);

// ----------[ requête ]---------- 
try {
    // requête 
    $qry = 'UPDATE users SET usr_fname=?, usr_lname=?, usr_adress=?, usr_zipcode=?, usr_city=? WHERE usr_mail=?';
    // on prépare la requête 
    $res = $cnn->prepare($qry);
    // on récupère le usr_mail 
    $mail = $_SESSION['usr_mail'];
    // on le rajoute à la fin du tableau de paramètres 
    array_push($params, $mail);
    // on execute la requête
    $res->execute($params);
    // et on redirige vers account avec message d'info (succès)
    header('location:account.php?c=b2');
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
