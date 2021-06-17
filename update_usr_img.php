<?php

// ----------[ SCRIPT - PHP ]---------- 
// mise à jour de la photo du user depuis le formulaire de la page account.php 
// 2 cas possibles : update ou delete, on a donc 2 'submit' différents en fonction du cas 
// 1) update —> via le script JS 'pw_check.js', on auto-submit le form dès que la nouvelle image est sélectionnée (1er 'submit') 
// 2) delete —> via le bouton 'supprimer' (= 2eme 'submit'), on update 'usr_img' avec la valeur 'NULL' 

// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête - update usr_img ]---------- 
// on définit le tableau de paramètres (vide pour l'instant)
$params = [];

try {
    // si une image est uploadée sans erreur 
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
            // et on le place dans le tableau $params à la place de $_POST['MAX_FILE_SIZE']
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
    }

    // en cas de suppression d'image, le formulaire est posté via le bouton "supprimer" qui est un input  
    if ($_POST['del_usr_img']) {
        $params[0] = NULL;
    }

    // ----------[ requête - update usr_img]---------- 
    // requête 
    $qry = 'UPDATE users SET usr_img=? WHERE usr_mail=?';
    // on prépare la requête 
    $res = $cnn->prepare($qry);
    // on récupère le usr_mail 
    $mail = $_SESSION['usr_mail'];
    // on le rajoute à la fin du tableau de paramètres 
    array_push($params, $mail);
    // on execute la requête
    $res->execute($params);
    // et on redirige vers account avec message d'info (succès)
    // echo "salut toi";
    // header('location:account.php?c=b2');
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
