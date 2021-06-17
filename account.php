<?php

// ----------[ PAGE - PHP ]---------- 
// Page compte utilisateur, permet la consultation et la modification des données personnelles

// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
try {
    $qry = 'SELECT * FROM users WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $res->execute(array($mail));
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// on parcours le résultat de la requête ligne à ligne 
$row = $res->fetch();

// ----------[ affichage des données user - V1 ]---------- 
// //on affiche les données du user sous forme de 'label' / 'input' grâce à une boucle 'foreach'
// // 👍 : s'adapte automatiquement aux (éventuelles) modifications de la structure de la BDD 
// // 👎 : mise en page (trop) uniforme / nom des 'labels' sont ceux de la BDD, pas avenant côté front et compliqués à modifier
// $label_and_input = "";
// //pour chaque ligne, on affiche sa clé dans le 'label' et sa valeur dans le 'input'
// // on slice le tableau associatif $row pour commencer à afficher à partir de la 4eme donnée car les 3 premières sont "confidentielles" (id et password)
// foreach (array_slice($row, 2) as $key => $val) {
//     $label_and_input .= '
//         <label>' . $key . '</label>
//             <div class="input-group mb-3">
//                 <input type="text" class="form-control" placeholder="' . $val . '" readonly>
//                 <div class="input-group-append">
//                     <button class="btn btn-outline-secondary" type="button">Modifier</button>
//                 </div>
//             </div>';
// }
// // contenu de la balise main ( = corps de page)
// $main_content = '
//     <div class="row">
//         <div class="col-3"></div>
//             <form class="col-6 highlight p-4 border rounded-lg mb-5" action="update_user.php" method="post">
//                 ' . $label_and_input . '
//             </form>
//         </div>
//     </div>';

// ----------[ affichage des données user - V2 ]---------- 
// on affiche les données dans un formulaire mis en page manuellement (pas de boucle) 
// 👍 : rendu visuel + agréable et modulation des noms de 'labels' + simple 
// 👎 : maintenance plus complexe : si la structure de la BDD change, le formulaire devra être réadapté 
// le formulaire est séparé en 2 parties : 
// 1) '$info_connect' contient 'email' et 'password', pour bien souligner l'aspect important de ces 2 données et ne pouvant être "null" dans la BDD 
// 2) '$info_perso' contient les infos perso (!), facultatives pour le user et pour la BDD 
// -> $row['col_name'] : récupère la valeur de la colonne dont le nom est "col_name" 
// -> array_keys($row)[col_num] : récupère le nom de la colonne numéro "col_num" 
$info_connect = '
    <div class="row">
        <div class="col-2"></div>
        <div class="highlight col-8 p-4 border rounded-lg mb-5">
            <div class="row mb-3">
                <legend class="col-md-7">Informations de sécurité</legend>
                <p class="col-md-5 text-right">
                    <button class="btn btn-outline-custom" type="button" data-toggle="collapse" data-target="#info_connect" aria-expanded="false" aria-controls="info_connect">Plus d\'infos <span class="ml-1">▾</span></button>
                </p>
                <div class="collapse" id="info_connect">
                    <div class="card card-body mb-3">
                        <p>Votre <em>email</em> et votre <em>mot de passe</em> servent à vous identifier sur notre site et protègent vos informations personnelles. Ils sont <strong>obligatoires</strong>.</p>
                        <p>Si vous souhaitez les modifier, cliquez dessus, remplissez les champs qui apparaitront, puis validez.</p>
                        <p><span class="mr-3">📨</span>L\'email doit être valide (vous recevrez un email de confirmation)</p>
                        <p><span class="mr-3">🔒</span>Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : <em>! . @ # $ % & * _ = + -</em></p> 
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="usr_mail">Email *</label>
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-secondary btn-block text-left" href="#" role="button" data-toggle="modal" data-target="#update_usr_mail">' . $row['usr_mail'] . '</a>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <label for="usr_pass">Mot de passe *</label>
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-secondary btn-block text-left" href="#" role="button" data-toggle="modal" data-target="#update_usr_pass">••••••••••••</a>
                    </div>
                </div>
            </div>
        </div>
    </div>';

$info_perso = '
    <div class="row">
        <div class="col-2"></div>
        <div class="highlight col-8 p-4 border rounded-lg mb-5">
            <div class="row mb-3">
                <legend class="col-md-7">Informations personnelles</legend>
                <p class="col-md-5 text-right">
                    <button class="btn btn-outline-custom" type="button" data-toggle="collapse" data-target="#info_perso" aria-expanded="false" aria-controls="info_perso">Plus d\'infos<span class="ml-1">▾</span></button>
                </p>
                <div class="collapse" id="info_perso">
                    <div class="card card-body mb-3">
                        <p>Ces informations sont les <em>vôtres</em>, vous en faites ce que vous voulez 😊</p> 
                        <p>Vous pouvez remplir ou vider les champs comme bon vous semble. Ces informations ne sont pas nécessaires, sauf si vous effectuez un achat, afin d\'établir une facture conforme.</p>
                        <p>Si vous souhaitez les modifier, remplissez (ou videz) les champs souhaités, puis validez en cliquant sur le bouton <strong>"Mettre à jour"</strong>.</p>
                        <p><span class="mr-3">📷</span>Pour modifier la <em>photo</em>, cliquez dessus et sélectionner un nouveau fichier, ou cliquez sur le bouton <strong>"Supprimer la photo"</strong> pour la retirer. L\'image doit être inférieure à <em>500 Ko</em> et de type <em>.jpg, .jpeg, .png</em> ou <em>.gif</em>.</p>
                        <p><span class="mr-3">📍</span>La <em>ville</em> se remplit automatiquement en fonction de votre <em>code postal</em>, ou fait apparaitre un menu déroulant si le code postal est commun à plusieurs villes.</p>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <form enctype="multipart/form-data" action="update_usr_img.php" method="post" id="update_usr_img" class="col-lg-3 col-md-5 d-inline">
                    <div id="reload" class="form-group">
                        <label class="d-block">Photo de profil</label>
                        <label for="usr_img">
                            <div class="usr_img_container rounded-lg d-flex justify-content-center align-items-center">
                                <div>
                                    <img id="usr_pic" alt="photo de profil utilisateur" src=' . (empty($row['usr_img']) ? "\"img/usr_logo.png\"" : $row['usr_img']) . '>
                                    <p class="usr_img_modif_text">Modifier</p>
                                </div>
                            </div>
                        </label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="512000">
                        <input type="file" name="usr_img" id="usr_img" accept=".gif, .jpg, .jpeg, .png" hidden>
                        <input type="submit" name="upd_usr_img" id="upd_usr_img" hidden>
                        <div>
                            <input type="submit" class="btn btn-outline-secondary" id="del_usr_img" name="del_usr_img" value="Supprimer la photo">
                        </div>
                    </div>
                </form>
                <form action="update_usr_info.php" method="post" class="col-lg-9">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="usr_fname">Prénom</label>
                            <input type="text" class="form-control" id="usr_fname" name="usr_fname" value="' . $row['usr_fname'] . '">
                        </div>
                        <div class="form-group col-6">
                            <label for="usr_lname">Nom</label>
                            <input type="text" class="form-control" id="usr_lname" name="usr_lname" value="' . $row['usr_lname'] . '">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr_address">Addresse</label>
                        <input type="text" class="form-control" id="usr_address" name="usr_address" value="' . $row['usr_adress'] . '">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-2">
                            <label for="usr_zipcode">Code postal</label>
                            <input type="text" class="form-control" id="usr_zipcode" name="usr_zipcode" value="' . $row['usr_zipcode'] . '">
                        </div>
                        <div class="form-group col-lg-10">
                            <label for="usr_city">Ville</label>
                            <input class="form-control" id="usr_city" name="usr_city" value="' . $row['usr_city'] . '" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-success float-right">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>';

$modal_mail = '
    <!-- ----------[ modal update_usr_mail ]---------- -->
    <div class="modal fade" id="update_usr_mail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modification de l\'email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_usr_mail.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old_usr_mail">Email actuel : </label>
                            <input class="form-control" type="email" name="old_usr_mail" id="old_usr_mail" placeholder="' . $row['usr_mail'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="new_usr_mail">Nouvel email : </label>
                            <input class="form-control" type="email" name="new_usr_mail" id="new_usr_mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-success" value="Mettre à jour">
                    </div>
                </form>
            </div>
        </div>
    </div>';

$modal_pass = '
    <!-- ----------[ modal update_usr_pass ]---------- -->
    <div class="modal fade" id="update_usr_pass" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modification du mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_usr_pass.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr_pass">Nouveau mot de passe : </label>
                            <input class="form-control" type="password" name="usr_pass" id="usr_pass" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                        </div>
                        <div class="form-group">
                            <label for="check">Vérification du nouveau mot de passe : </label>
                            <input class="form-control" type="password" name="check" id="check" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-success" value="Mettre à jour">
                    </div>
                </form>
            </div>
        </div>
    </div>';

// ----------[ assemblage de la page web ]---------- 

// titre principal de la page
$page_title = 'Mon compte';

// contenu de la balise 'main' ( = corps de page)
$main_content = $info_connect . $modal_pass . $modal_mail . $info_perso;

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index, 1 = playground, 2 = activities, 3 = help, 4 = account
$active = [false, false, false, false, true];

// [optionnel] fichier de script externe 
$script = 'account.js';

// récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
