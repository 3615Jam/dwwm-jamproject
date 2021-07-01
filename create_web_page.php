<?php

// ----------[ SCRIPT - PHP ]---------- 

/**
 * -------------------------
 * -  "createWebPage" : 
 * -------------------------
 * 
 * Fonction qui permet de générer les différentes pages du site, en partant toujours du même template 
 * 
 * @param     string    $page_title      Titre de la page web, utilisé dans la balise 'title' du head et dans le 'h1' du body 
 * @param     string    $main_content    Contenu HTML à afficher dans la balise 'main' 
 * @param     array     $active          Tableau de bouléens, sert à rendre l'onglet du menu 'nav' actif ( = coloré) sur la page correspondante 
 * @param     string    $script_perso    [optionnel] Nom du fichier de script externe à utiliser (vide par défaut)
 * 
 * @return    string    $html            Code HTML complet de la page à générer 
 * 
 */

function createWebPage($page_title, $main_content, $active, $script_perso = '')
{
    // ----------[ imports ]---------- 
    include_once('constants.php');

    // ----------[ démarrage ou récupération de session ]---------- 
    session_start();
    $connected = false;
    if (isset($_SESSION['connected']) && ($_SESSION['connected'])) {
        $connected = $_SESSION['connected'];
    }

    // ----------[ messages d'information en cas de redirection depuis une autre page ]---------- 
    $redirection_message = '';
    if (isset($_GET['c']) && !empty($_GET['c'])) {
        switch ($_GET['c']) {
            case 'u1':
                $redirection_message = U1;
                break;
            case 'u2':
                $redirection_message = U2;
                break;
            case 'u3':
                $redirection_message = U3;
                break;
            case 'u4':
                $redirection_message = U4;
                break;
            case 'u5':
                $redirection_message = U5;
                break;
            case 'b2':
                $redirection_message = B2;
                break;
            default:
                $redirection_message = 'Rien à signaler';
        }
    }

    // ----------[ let's go ]---------- 
    $page_start = '
    <!-- ----------[ html ]---------- -->
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $page_title . '</title>
        <link rel="icon" type="ico" href="img/jamproject-64.png">
        <!-- ----------[ bootstrap - css ]---------- -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- ----------[ jQuery ]---------- -->
        <!-- bootstrap 4 utilise la version "slim" de jQuery, incompatible (entre autres) avec AJAX, dont on a besoin -->
        <!-- on importe donc (avant le bundle js de bootstrap !) la version complète (et mise à jour) de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- ----------[ bootstrap - js ]---------- -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- ----------[ custom - css ]---------- -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- ----------[ custom - js ]---------- -->
        <script defer src="script.js"></script>
        <script defer src="' . $script_perso . '"></script>
    </head>
    <body class="container-fluid">';

    $nav = '
        <ul class="d-flex justify-content-around text-decoration-none">
            <li><a class="btn btn-outline-success ' . ($active[0] ? "active" : "") . '" role="button" href="index2.php">Accueil</a></li>
            <li><a class="btn btn-outline-success ' . ($active[1] ? "active" : "") . '" role="button" href="playground.php">Aire de jeux</a></li>
            <li><a class="btn btn-outline-success ' . ($active[2] ? "active" : "") . '" role="button" href="activities.php">Activités</a></li>
            <li><a class="btn btn-outline-success ' . ($active[3] ? "active" : "") . '" role="button" href="help.php">Aide</a></li>
            <li><a class="btn btn-outline-success" role="button" href="#" data-toggle="modal" data-target="#contact">Contact</a></li>
        </ul>';

    // ----------[ login zone - contenu variable ]---------- 
    // en fonction du statut de $connected, on n'affiche pas les mêmes boutons dans cette zone :
    // user déconnecté : on affiche les boutons "inscription" et "connexion"
    // user connecté : on affiche les boutons "compte" et "déconnexion"

    // boutons à afficher quand user co 
    $buttons_co = '
                <div class="m-3">
                    <p class="btn_connexion_label">Accès à mon compte</p>
                    <a class="btn ' . ($active[4] ? "btn-success" : "btn-outline-success") . ' btn-lg" href="account.php" role="button">Compte</a>
                </div>
                <div class="m-3">
                    <p class="btn_connexion_label">Déconnexion</p>
                    <a class="btn btn-outline-custom btn-lg" href="logout.php" role="button">A bientôt</a>
                </div>';

    // boutons à afficher quand user déco 
    $buttons_deco = '
                <div class="m-3">
                    <p class="btn_connexion_label">Nouvel utilisateur ?</p>
                    <a class="btn btn-outline-success btn-lg" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
                </div>
                <div class="m-3">
                    <p class="btn_connexion_label">Déjà inscrit ?</p>
                    <a class="btn btn-outline-custom btn-lg" href="#" role="button" data-toggle="modal" data-target="#login">Connexion</a>
                </div>';

    // affichage des boutons adéquats via un ternaire 
    // echo ($connected ? $buttons_co : $buttons_deco);

    $login_zone = ($connected ? $buttons_co : $buttons_deco);

    $header = '
        <header class="row align-items-center text-center mb-2">
            <div id="logo_zone" class="col-lg-2 col-sm-2">
                <img id="logo" src="img/bg-logo.png" alt="logo jam project">
            </div>
            <div id="main_title" class="col-lg-8 col-sm-10 align-self-end">
                <h1 class="m-5">' . $page_title . '</h1>
            </div>
            <div id="login_zone" class="col-lg-2 col-sm-12">' . $login_zone . '</div>
        </header>';

    $main = '
        <div class="row">
            <div class="col-2"></div>
            <nav class="col-8 mb-3">' . $nav . '</nav>
        </div>
        <main><div id="redirection_message">' . $redirection_message . '</div> ' . $main_content . ' </main>';

    $footer = '<footer class="text-center"><p><small>© 2021 - Jam Project</small></p></footer>';

    $modal = '
        <!-- ----------[ modal inscription ]---------- -->
        <div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="register.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr_mail">Email : </label>
                                <input class="form-control" type="email" name="usr_mail" id="usr_mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="form-group">
                                <label for="usr_pass">Mot de passe : </label>
                                <input class="form-control" type="password" name="usr_pass" id="usr_pass" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                            </div>
                            <div class="form-group">
                                <label for="check">Vérification du mot de passe : </label>
                                <input class="form-control" type="password" name="check" id="check" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn btn-success" value="S\'inscrire">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------[ modal login ]---------- -->
        <div class="modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="login.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr_mail">Email : </label>
                                <input class="form-control" type="email" name="usr_mail" id="usr_mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="form-group">
                                <label for="usr_pass">Mot de passe : </label>
                                <input class="form-control" type="password" name="usr_pass" id="usr_pass" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn btn-success" value="Se connecter">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------[ modal contact ]---------- -->
        <div class="modal fade" id="contact" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="contact.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fname">Nom : </label>
                                <input class="form-control" type="text" name="fname" id="fname" pattern="[A-Za-z]{2,}" title="Lettres uniquement (au moins 2)" required>
                            </div>
                            <div class="form-group">
                                <label for="usr_mail">Email : </label>
                                <input class="form-control" type="email" name="usr_mail" id="usr_mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="form-group">
                                <label for="request">Demande : </label>
                                <textarea class="form-control" type="text" name="request" id="request" rows="8" placeholder="Comment peut-on vous aider ?" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" class="btn btn-success" value="Envoyer">
                        </div>
                    </form>
                </div>
            </div>
        </div>';

    $page_end = '</body></html>';

    // assemblage et renvoi de la page complète 
    $html = $page_start . $header . $main . $footer . $modal . $page_end;
    return $html;
}
