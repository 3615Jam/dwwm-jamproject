<?php

include_once('constants.php');
include_once('session_check.php');
include_once('pdo_connect.php');

var_dump($_POST['zip']);
var_dump($_POST['city']);

// header('location:test.php');

$qry = 'UPDATE usr SET zipcode=? WHERE mail=?';
$res = $cnn->prepare($qry);
$res->execute([$_POST['zip'], 'jm@greta.fr']);
