<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');
include_once('pdo_connect.php');

// ----------[ requête ]---------- 
// on récupère les activités du user connecté
try {
    $qry = 'SELECT * FROM act a 
            JOIN usr_act ua ON a.id = ua.act_id 
            JOIN usr u ON u.id = ua.usr_id
            WHERE u.mail = ?;';
    $res = $cnn->prepare($qry);
    $mail = $_SESSION['usr_mail'];
    $res->execute(array($mail));
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}

// on parcours le résultat de la requête ligne à ligne 
$row = $res->fetchAll();
// var_dump($row);

$usr_act = [];
$html = "";
foreach ($row as $key => $val) {
    array_push($usr_act, $row[$key]['name']);
    $html .= '
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="' . $row[$key]['name'] . '" value="' . $row[$key]['name'] . '">
            <label class="form-check-label" for="' . $row[$key]['name'] . '">' . $row[$key]['name'] . '</label>
        </div>';
}
// var_dump($usr_act);






// ----------[ génération de la page web ]---------- 
$pg_menu = '
<div>
    <div class="fixed-bottom">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Mes Activités</h5>
                <span class="text-white">' . $html . '</span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
</div>';

$test = '
<div id="test-div">test-div</div>
<div class="test-hide">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum, architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error, dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
Quidem cupiditate nesciunt libero est placeat consectetur aliquam ipsa error facere sint, odit sapiente culpa, beatae at tempora! Dignissimos amet necessitatibus pariatur assumenda tempora odio magnam magni id sit atque.
Facilis voluptate id fugiat ut ipsa exercitationem ipsum cupiditate ducimus? Quo minus quisquam laboriosam quidem error itaque dolore quas. Ad, commodi? Temporibus quod facere corporis, quidem fugiat impedit debitis placeat!
Omnis minima quia assumenda magnam dolore rem inventore nisi in porro laudantium unde, aperiam quasi ea corrupti illum odit quisquam, optio, dolores ullam soluta quam. Enim dicta amet soluta consequatur.
Eveniet voluptatum corrupti consequatur, accusantium nam modi, aliquid atque velit labore, nihil asperiores. Odio, asperiores illo doloremque velit modi nesciunt temporibus aut suscipit soluta culpa libero sed, quibusdam iusto minima!
Ullam in unde suscipit, delectus molestiae vero illo quos nobis animi, nostrum consequuntur dolore officiis magni adipisci accusamus. Quo, numquam non aliquid quam repellendus facere ducimus minima iusto natus nobis.
Vero autem enim harum, nesciunt rem error obcaecati sequi ad ipsum, dicta esse? Delectus perferendis quo nobis, repellat, impedit expedita maxime illo saepe fugit quae rerum quidem! Eos, aspernatur. Porro.
Magni dolorem aliquid et, earum dolore corrupti. Sit id nobis corporis exercitationem, praesentium vel aliquid molestiae nulla porro quibusdam accusantium magni ullam ea omnis dicta perspiciatis! Quibusdam at dolores doloremque.
Nihil modi labore quod culpa illo, pariatur eligendi sit ducimus, repudiandae suscipit ipsa itaque ex quasi, molestias quisquam officiis. Consequuntur, modi magni. Ipsa perferendis cupiditate illum, quas nemo velit ipsam!
Nemo explicabo ullam illum nesciunt rerum ut at consectetur, optio neque, sequi nostrum vel vitae quod quae consequatur velit ipsa? Laudantium nesciunt commodi aut quia eius totam possimus iusto itaque!
Magnam placeat mollitia quasi voluptas commodi nulla non iste eligendi nostrum qui alias ex voluptatem quae saepe aspernatur enim odit, exercitationem explicabo nobis at! Ipsam, eos? Maiores reprehenderit culpa hic.
Distinctio accusamus iure vel dicta, recusandae, illo reprehenderit animi repellendus eius porro, repellat impedit. Dolorem asperiores alias perspiciatis repellat neque, quis obcaecati officia fuga illum beatae minus reiciendis delectus tenetur.
Veniam commodi adipisci mollitia reprehenderit esse iure corrupti modi iusto aspernatur quis fuga similique ut, officia at fugit eveniet illo cumque, aliquid laboriosam alias quidem rerum quos quibusdam provident! Ipsum?
Quisquam magnam laudantium temporibus voluptates, suscipit repudiandae nisi, neque beatae, natus tenetur quibusdam a quia deserunt adipisci! Impedit itaque dolore, numquam distinctio officiis autem iusto laborum, illum atque corporis id.
Sed eligendi saepe ea incidunt accusamus blanditiis quia quas debitis laboriosam! Enim esse delectus voluptatem aut reiciendis corporis aliquid repellendus, vitae minus qui? Totam ipsa itaque rem cupiditate voluptate sint!
Expedita at, suscipit eum iusto aliquam consectetur reiciendis doloremque nihil veritatis hic dolor omnis soluta voluptatem amet dignissimos dolore excepturi vero non sequi. Delectus ipsa sit voluptatibus voluptatem. Reiciendis, quibusdam!
Soluta ad amet quae expedita dolorum. Molestias consequuntur rem cum explicabo, obcaecati laudantium velit illo, inventore ad laboriosam odio sequi aspernatur esse doloribus reiciendis illum qui placeat nam! Accusantium, aliquid.
Repellat dolorem dolorum libero, ea odit ipsum ipsam obcaecati, optio fuga provident tempore commodi facere quaerat perspiciatis quidem eveniet voluptatum? Adipisci non hic quia fuga quos neque numquam voluptates nemo!</div>

<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum, architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error, dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
Quidem cupiditate nesciunt libero est placeat consectetur aliquam ipsa error facere sint, odit sapiente culpa, beatae at tempora! Dignissimos amet necessitatibus pariatur assumenda tempora odio magnam magni id sit atque.
Facilis voluptate id fugiat ut ipsa exercitationem ipsum cupiditate ducimus? Quo minus quisquam laboriosam quidem error itaque dolore quas. Ad, commodi? Temporibus quod facere corporis, quidem fugiat impedit debitis placeat!
Omnis minima quia assumenda magnam dolore rem inventore nisi in porro laudantium unde, aperiam quasi ea corrupti illum odit quisquam, optio, dolores ullam soluta quam. Enim dicta amet soluta consequatur.
Eveniet voluptatum corrupti consequatur, accusantium nam modi, aliquid atque velit labore, nihil asperiores. Odio, asperiores illo doloremque velit modi nesciunt temporibus aut suscipit soluta culpa libero sed, quibusdam iusto minima!
Ullam in unde suscipit, delectus molestiae vero illo quos nobis animi, nostrum consequuntur dolore officiis magni adipisci accusamus. Quo, numquam non aliquid quam repellendus facere ducimus minima iusto natus nobis.
Vero autem enim harum, nesciunt rem error obcaecati sequi ad ipsum, dicta esse? Delectus perferendis quo nobis, repellat, impedit expedita maxime illo saepe fugit quae rerum quidem! Eos, aspernatur. Porro.
Magni dolorem aliquid et, earum dolore corrupti. Sit id nobis corporis exercitationem, praesentium vel aliquid molestiae nulla porro quibusdam accusantium magni ullam ea omnis dicta perspiciatis! Quibusdam at dolores doloremque.
Nihil modi labore quod culpa illo, pariatur eligendi sit ducimus, repudiandae suscipit ipsa itaque ex quasi, molestias quisquam officiis. Consequuntur, modi magni. Ipsa perferendis cupiditate illum, quas nemo velit ipsam!
Nemo explicabo ullam illum nesciunt rerum ut at consectetur, optio neque, sequi nostrum vel vitae quod quae consequatur velit ipsa? Laudantium nesciunt commodi aut quia eius totam possimus iusto itaque!
Magnam placeat mollitia quasi voluptas commodi nulla non iste eligendi nostrum qui alias ex voluptatem quae saepe aspernatur enim odit, exercitationem explicabo nobis at! Ipsam, eos? Maiores reprehenderit culpa hic.
Distinctio accusamus iure vel dicta, recusandae, illo reprehenderit animi repellendus eius porro, repellat impedit. Dolorem asperiores alias perspiciatis repellat neque, quis obcaecati officia fuga illum beatae minus reiciendis delectus tenetur.
Veniam commodi adipisci mollitia reprehenderit esse iure corrupti modi iusto aspernatur quis fuga similique ut, officia at fugit eveniet illo cumque, aliquid laboriosam alias quidem rerum quos quibusdam provident! Ipsum?
Quisquam magnam laudantium temporibus voluptates, suscipit repudiandae nisi, neque beatae, natus tenetur quibusdam a quia deserunt adipisci! Impedit itaque dolore, numquam distinctio officiis autem iusto laborum, illum atque corporis id.
Sed eligendi saepe ea incidunt accusamus blanditiis quia quas debitis laboriosam! Enim esse delectus voluptatem aut reiciendis corporis aliquid repellendus, vitae minus qui? Totam ipsa itaque rem cupiditate voluptate sint!
Expedita at, suscipit eum iusto aliquam consectetur reiciendis doloremque nihil veritatis hic dolor omnis soluta voluptatem amet dignissimos dolore excepturi vero non sequi. Delectus ipsa sit voluptatibus voluptatem. Reiciendis, quibusdam!
Soluta ad amet quae expedita dolorum. Molestias consequuntur rem cum explicabo, obcaecati laudantium velit illo, inventore ad laboriosam odio sequi aspernatur esse doloribus reiciendis illum qui placeat nam! Accusantium, aliquid.
Repellat dolorem dolorum libero, ea odit ipsum ipsam obcaecati, optio fuga provident tempore commodi facere quaerat perspiciatis quidem eveniet voluptatum? Adipisci non hic quia fuga quos neque numquam voluptates nemo!</div>
';

// 1) définition des paramètres

// titre principal de la page
$page_title = "Aire de jeux";

// contenu de la balise main ( = corps de page)
$main_content = $pg_menu . '<div id="playground">' . $test . '</div>';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index.php, 1 = playground.php, 2 = activities.php, 3 = help.php
$active = [false, true, false, false];

// [optionnel] fichier de script externe 
$script = '';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
