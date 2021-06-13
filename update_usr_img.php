<?php

// ----------[ SCRIPT - PHP ]---------- 
// suppression de la photo du user depuis le formulaire de la page account.php

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
try {
    $qry = 'UPDATE users SET usr_img=? WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $params = array('', $mail);
    $res->execute($params);
    header('location:account.php?c=b2');
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
