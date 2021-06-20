<?php

// ----------[ SCRIPT - PHP ]---------- 
// mise à jour des info perso du user depuis le formulaire de la page account.php

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ paramètres ]---------- 
$params[] = password_hash(htmlspecialchars($_POST['usr_pass']), PASSWORD_DEFAULT);

// ----------[ requête ]---------- 
try {
    // requête 
    $qry = 'UPDATE usr SET pass=? WHERE mail=?';
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
