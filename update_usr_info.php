<?php

// ----------[ SCRIPT - PHP ]---------- 
// mise à jour des info perso du user depuis le formulaire de la page account.php

// ----------[ imports ]---------- 

use phpDocumentor\Reflection\Location;

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
// si une image est uploadée (sans erreur) 
try {
    if (isset($_FILES['usr_img']) && $_FILES['usr_img']['error'] !== UPLOAD_ERR_NO_FILE) {
        // on définit un tableau pour les extensions autorisées 
        $authorized_extensions = array('gif', 'jpg', 'jpeg', 'png');
        // on récupère l'extension du fichier uploadé 
        $file_ext = strtolower(substr($_FILES['usr_img']['type'], strpos($_FILES['usr_img']['type'], '/') + 1));
        // on récupère la taille du fichier uploadé 
        $file_size = $_FILES['usr_img']['size'];
        // on récupère le nom temporaire du fichier uploadé 
        $file_temp = $_FILES['usr_img']['tmp_name'];
        // on teste les erreurs possibles (extension et taille du fichier) 
        $errors = [];
        if (!in_array($file_ext, $authorized_extensions)) {
            $errors[] = '<p class="alert alert-danger">Extension de fichier non autorisée ! Seules les extensions suivantes sont autorisées : ' . implode(',', $authorized_extensions) . '</p>';
        }
        if ($file_size > (int) $_POST['MAX_FILE_SIZE']) {
            $errors[] = '<p class="alert alert-danger">Taille de fichier dépassée : ' . ($_POST['MAX_FILE_SIZE'] / 1024) . ' Ko maximum</p>';
        }
        // si pas d'erreurs
        if (empty($errors)) {
            // on récupère le contenu "binaire" du fichier uploadé sous forme de chaine 
            $bin = file_get_contents($file_temp);
            // puis on encode celui-ci en base64 
            $base64 = 'data:' . $file_ext . ';base64,' .   base64_encode($bin);
            // et on le place 'base64' dans le tableau $params à la place de $_POST['MAX_FILE_SIZE']
            $params[0] = $base64;
        } else {
            // sinon on remonte les erreurs 
            foreach ($errors as $error) {
                echo $error;
            }
            // et on redirige vers account.php
            echo '<a href="account.php">Retour</a>';
            exit();
        }
    } else {
        // s'il y a déjà une image, on récupère sa valeur et la place dans le tableau $params à la place de $_POST['MAX_FILE_SIZE'] 
        $params[0] = $_POST['img_value'];
    }
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// ----------[ requête ]---------- 
try {
    $qry = 'UPDATE users SET usr_img=?, usr_fname=?, usr_lname=?, usr_adress=?, usr_zipcode=?, usr_city=? WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    array_push($params, $mail);
    $res->execute($params);
    header('location:account.php?c=b2');
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
