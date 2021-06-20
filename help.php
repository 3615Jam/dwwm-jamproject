<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');

// ----------[ génération de la page web ]---------- 
// 1) définition des paramètres

// titre principal de la page
$page_title = "Aide";

// contenu de la balise main ( = corps de page)
$main_content = '
<div class="row">
    <div class="col-2"></div>
    <div class="col-8 accordion mb-5" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><em>Besoin d\'aide ? Nous sommes là !</em></button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body text-center">
                    <p>Nous souhaitons que vous viviez la <em>meilleure</em> expérience possible !<br> C\'est pour cela que nous sommes avec vous si avez la moindre question.</p>
                    <p>Vous trouverez ci-dessous les réponses aux interrogations les plus fréquemment rencontrées.</p>
                    <p>Et si vous avez besoin d\'une assistance plus <em>personnelle</em>,<br> vous pouvez aussi nous envoyer un message par l\'intermédiaire du bouton <strong>Contact</strong> dans le menu ci-dessus ⬆️</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><em>Aide sujet #2</em></button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum,
                    architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
                    Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error,
                    dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
                    Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt
                    consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><em>Aide sujet #3</em></button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum,
                    architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
                    Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error,
                    dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
                    Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt
                    consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><em>Aide sujet #4</em></button>
                </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum,
                    architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
                    Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error,
                    dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
                    Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt
                    consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><em>Aide sujet #5</em></button>
                </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptates natus pariatur quam modi quo ipsum,
                    architecto nobis amet, eaque dolore veritatis, totam voluptas perspiciatis in dignissimos asperiores distinctio fuga?
                    Suscipit laboriosam, veritatis architecto placeat et quisquam expedita sit aut reprehenderit saepe consectetur id error,
                    dignissimos cum repellat deserunt voluptates porro harum iure veniam doloremque. Recusandae sapiente labore illo id?
                    Dolorem iure deserunt non veritatis eius unde quod placeat dolores. Inventore dolorem voluptatum et, nesciunt
                    consequatur adipisci culpa debitis ex est iure non, molestias eligendi quasi nam provident repellat officiis!
                </div>
            </div>
        </div>
    </div>
</div>
';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index, 1 = playground, 2 = activities, 3 = help, 4 = account
$active = [false, false, false, true, false];

// [optionnel] fichier de script externe 
$script = '';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
