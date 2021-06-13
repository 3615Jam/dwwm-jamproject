<?php

// ----------[ SCRIPT - PHP ]---------- 
// on vérifie si user existe dans BDD grâce à 'usr_mail' 
// puis on vérifie la concordance entre les 'usr_pass' et 

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('pdo_connect.php');

try {
    // si présents et non vides, on récupère 'usr_mail' et 'usr_pass' de $_POST 
    if (isset($_POST['usr_mail']) && !empty($_POST['usr_mail'])) {
        // par sécurité, on échappe les caractères spéciaux HTML 
        $mail = htmlspecialchars($_POST['usr_mail']);
    }

    if (isset($_POST['usr_pass']) && !empty($_POST['usr_pass'])) {
        // par sécurité, on échappe les caractères spéciaux HTML 
        $pass = htmlspecialchars($_POST['usr_pass']);
    }

    // on prépare de la requête 
    $qry = 'SELECT * FROM users WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    // on execute la requête avec les valeurs 
    $res->execute(array($mail));
    $row = $res->fetch();
    // si $row est un tableau, c'est qu'il y a une concordance de l'email 
    if (is_array($row) && password_verify($pass, $row['usr_pass'])) {
        // on vérifie alors si '$pass' coïncide avec le mot de passe crypté stocké en BDD 
        // if (password_verify($pass, $row['usr_pass'])) {
        // dans ce cas, on initialise la session 
        session_start();
        $_SESSION['connected'] = true;
        $_SESSION['session_id'] = session_id();
        $_SESSION['usr_fname'] = $row['usr_fname'];
        $_SESSION['usr_mail'] = $mail;
        // et on redirige vers playground.php
        header('location:playground.php');
        // } else {
        //     echo "salut toi";
        // }
    } else {
        // sinon on redirige vers accueil avec message d'info 
        header('location:index2.php?c=u2');
    }
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
