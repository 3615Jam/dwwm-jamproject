<?php

// ----------[ SCRIPT - PHP ]---------- 
// mise à jour des info perso du user depuis le formulaire de la page account.php

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ paramètres ]---------- 
$params[] = htmlspecialchars($_POST['new_usr_mail']);

// ----------[ requête ]---------- 
try {
    // requête 
    $qry = 'UPDATE users SET usr_mail=? WHERE usr_mail=?';
    // on prépare la requête 
    $res = $cnn->prepare($qry);
    // on récupère le usr_mail 
    $mail = $_SESSION['usr_mail'];
    // on le rajoute à la fin du tableau de paramètres 
    array_push($params, $mail);
    // on execute la requête
    $res->execute($params);
    // on oublie pas de mettre à jour aussi le usr_mail dans $_SESSION 
    $_SESSION['usr_mail'] = $_POST['new_usr_mail'];
    // et on redirige vers account avec message d'info (succès)
    header('location:account.php?c=b2');
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
