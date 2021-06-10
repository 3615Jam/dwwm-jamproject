<?php

// Login : script de vérification user 

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
    $qry = "SELECT * FROM users WHERE usr_mail=?";
    $res = $cnn->prepare($qry);
    // on prépare les valeurs 
    $vals = array($mail);
    // on execute la requête avec les valeurs 
    $res->execute($vals);
    $row = $res->fetch();
    var_dump($row);

    if (is_array($row)) {
        if (password_verify($pass, $row['usr_pass'])) {

            // si 1 ligne est retournée --> match ok ! on se connecte
            // if ($res->rowCount() === 1) {
            // démarrage (ou récupération si existe) de session 
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['session_id'] = session_id();
            $_SESSION['usr_fname'] = $row['usr_fname'];
            $_SESSION['usr_mail'] = $_POST['usr_mail'];
            // routage vers playground.php
            header('location:playground.php');
        }
    } else {
        // routage vers index2.php avec infos 
        header('location:index2.php?c=2');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
