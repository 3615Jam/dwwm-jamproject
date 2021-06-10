<?php

// ----------[ TYPE = PAGE ]---------- 
// Page compte utilisateur, permet la consultation et la modification des données personnelles

// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ génération de la page web ]---------- 
// titre principal de la page
$page_title = "Mon compte";

// requête pour récupérer les informations du user dans la BDD 
try {
    $qry = 'SELECT * FROM users WHERE usr_mail=?';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $res->execute(array($mail));
} catch (PDOException $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// on parcours le résultat de la requête ligne à ligne 
$row = $res->fetch();

// ----------[ affichage des données user - V1 ]---------- 
// //on affiche les données du user sous forme de 'label' / 'input' grâce à une boucle 'foreach'
// // 👍 : s'adapte aux modifications de la structure de la BDD 
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
            <form class="highlight col-8 p-4 border rounded-lg mb-5" action="update_user.php" method="post">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="' . array_keys($row)[2] . '">Email *</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" id="' . array_keys($row)[2] . '" name="' . array_keys($row)[2] . '" placeholder="' . $row['usr_mail'] . '" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Modifier</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="' . array_keys($row)[1] . '">Mot de passe *</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="' . array_keys($row)[1] . '" name="' . array_keys($row)[1] . '" placeholder="••••••••••••" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>';

$info_perso = '
    <div class="row">
        <div class="col-2"></div>
            <form class="highlight col-8 p-4 border rounded-lg mb-5" action="update_user.php" method="post">    
                <div class="form-row">
                    <div class="col-lg-3">
                        <div class="form-group"
                            <label for="' . array_keys($row)[8] . '">Photo de profil</label>
                            <div>
                                <img style="width:150px" class="mx-auto" alt="photo de profil utilisateur" src="img/usr_logo.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="' . array_keys($row)[3] . '">Prénom</label>
                            <input type="text" class="form-control" id="' . array_keys($row)[3] . '" name="' . array_keys($row)[3] . '" value="' . $row['usr_fname'] . '">
                        </div>
                        <div class="form-group">
                            <label for="' . array_keys($row)[4] . '">Nom</label>
                            <input type="text" class="form-control" id="' . array_keys($row)[4] . '" name="' . array_keys($row)[4] . '" value="' . $row['usr_lname'] . '">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="' . array_keys($row)[5] . '">Addresse</label>
                    <input type="text" class="form-control" id="' . array_keys($row)[5] . '" name="' . array_keys($row)[5] . '" value="' . $row['usr_address'] . '">
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <label for="' . array_keys($row)[7] . '">Code postal</label>
                        <input type="text" class="form-control" id="' . array_keys($row)[7] . '" name="' . array_keys($row)[7] . '" value="' . $row['usr_zipcode'] . '">
                    </div>
                    <div class="form-group col-lg-10">
                        <label for="' . array_keys($row)[6] . '">Ville</label>
                        <input type="text" class="form-control" id="' . array_keys($row)[6] . '" name="' . array_keys($row)[6] . '" value="' . $row['usr_city'] . '" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-right">Mettre à jour</button>
            </form>
        </div>
    </div>';

// contenu de la balise main ( = corps de page)
$main_content = $info_connect . $info_perso;

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index, 1 = playground, 2 = activities, 3 = help, 4 = account
$active = [false, false, false, false, true];

// [optionnel] fichier de script externe 
$script = '';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
