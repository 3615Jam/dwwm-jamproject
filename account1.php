<?php
// ----------[ imports ]---------- 
include_once('constants.php');
include_once('session_check.php');
?>

<!-- ----------[ html ]---------- -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWWM - Jam Project | Mon Compte</title>
    <link rel="icon" type="ico" href="img/jamproject-64.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- ----------[ bootstrap - css ]---------- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- ----------[ bootstrap - js  ]---------- -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- ----------[ scripts perso ]---------- -->
    <script defer src=""></script>
</head>

<body class="container-fluid">
    <header class="row align-items-center text-center">
        <div id="logo" class="col-2">
            <img src="img/jamproject-128.png" alt="logo jam project">
        </div>
        <div id="main_title" class="col-7">
            <div class="m-5">
                <h1>Jam Project - Mon compte</h1>
            </div>
            <nav>
                <ul class="d-flex justify-content-around text-decoration-none">
                    <li>Accueil</li>
                    <li>Actualités</li>
                    <li>Activités</li>
                    <li>Contact</li>
                </ul>
            </nav>
        </div>
        <div id="login_zone" class="col-3">
            <div class="m-3">
                <h5>Accès à mon compte</h5>
                <a class="btn btn-info btn-lg" href="playground.php" role="button">Playground</a>
            </div>
            <div class="m-3">
                <h5>Deconnexion</h5>
                <a class="btn btn-danger btn-lg" href="logout.php" role="button">A bientôt</a>
            </div>
        </div>
    </header>

    <main>

    </main>

    <footer class="text-center">
        <p>© 2021 - Jam Project</p>
    </footer>

</body>

</html>