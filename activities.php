<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');

// ----------[ génération de la page web ]---------- 
// 1) définition des paramètres 

// titre principal de la page
$page_title = "Activités";

// contenu de la balise main ( = corps de page)
$main_content = '
    <section class="row align-items-center text-center">
        <aside class="col-2">##### aside ##### Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quasi cumque maiores et fuga, veritatis natus. Ipsum perspiciatis ipsam sed tempora sint quasi, quod possimus cum asperiores! Voluptatem, minima et!</aside>
        <article class="col-10">##### article ##### Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quasi cumque maiores et fuga, veritatis natus. Ipsum perspiciatis ipsam sed tempora sint quasi, quod possimus cum asperiores! Voluptatem, minima et! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quasi cumque maiores et fuga, veritatis natus. Ipsum perspiciatis ipsam sed tempora sint quasi, quod possimus cum asperiores! Voluptatem, minima et! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quasi cumque maiores et fuga, veritatis natus. Ipsum perspiciatis ipsam sed tempora sint quasi, quod possimus cum asperiores! Voluptatem, minima et!</article>
    </section>';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index, 1 = playground, 2 = activities, 3 = help, 4 = account
$active = [false, false, true, false, false];

// [optionnel] fichier de script externe 
$script = "";

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau en liste d'arguments 
echo (createWebPage(...$params));
