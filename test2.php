<?php

include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

var_dump($_POST['zip']);
var_dump($_POST['city']);

// header('location:test.php');

$qry = 'UPDATE users SET usr_address=? WHERE usr_mail=?';
$res = $cnn->prepare($qry);
$res->execute([$_POST['zip'], 'jm@greta.fr']);
