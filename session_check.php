<?php

// ----------[ SCRIPT - PHP ]---------- 
// vérification si user est connecté ou pas, sinon redirige vers index.php avec message pour éviter un accès manuel aux autres pages du site

session_start();
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('location:index2.php?c=u3');
    exit();
}
