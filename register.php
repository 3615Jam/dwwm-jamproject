<?php

// ----------[ SCRIPT - PHP ]---------- 
// enregistrement d'un nouvel utilisateur via le formulaire d'inscription 

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
try {
    // 1) on commence par vérifier si le mail existe déjà 
    $qry = 'SELECT * FROM users WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = htmlspecialchars($_POST['usr_mail']);
    $res->execute(array($mail));
    // s'il retourne une ligne, c'est que le mail est déjà dans la BDD ...
    if ($res->rowCount() === 1) {
        // ... donc on redirige vers page d'accueil avec code info approprié 
        header('location:index2.php?c=u5');
    } else {
        // 2) sinon on le crée 
        // requête 
        $qry = 'INSERT INTO users (usr_mail, usr_pass) VALUES (?, ?)';
        // on prépare la requête 
        $res = $cnn->prepare($qry);
        // on récupère le mail en échappant les caractères spéciaux html
        $mail = htmlspecialchars($_POST['usr_mail']);
        // on récupère le password, on le crypte après avoir échappé les caractères spéciaux html
        $pass = password_hash(htmlspecialchars($_POST['usr_pass']), PASSWORD_DEFAULT);
        // on execute la requête préparée grâce aux paramètres '$mail' et '$pass'
        $res->execute(array($mail, $pass));
        // puis on redirige vers page d'accueil avec code info approprié 
        header('location:index2.php?c=u1');
    }
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
