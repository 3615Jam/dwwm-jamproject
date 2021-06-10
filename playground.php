<?php
// ----------[ imports ]---------- 
include_once('create_web_page.php');
include_once('session_check.php');

// ----------[ génération de la page web ]---------- 
// 1) définition des paramètres

// titre principal de la page
$page_title = "Aire de jeux";

// contenu de la balise main ( = corps de page)
$main_content = '
<div id="playground">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quasi cumque eaque commodi, eveniet voluptas laborum quam tenetur ea architecto expedita unde delectus accusamus aut maiores, cum aperiam at distinctio?
        Quidem, deserunt provident? Non, minima minus nulla, deleniti accusamus itaque, dolores exercitationem veritatis eos excepturi quia repellendus facere necessitatibus expedita adipisci unde officia? Odit, quo quos aliquid repellat consectetur illum.
        Accusamus impedit ad ex doloribus reiciendis necessitatibus, iure, dolores velit, corrupti veritatis tenetur cupiditate minus laborum quas earum laboriosam natus nemo quod error nihil non quibusdam cum animi aliquid. Accusantium.
        Provident, obcaecati dolore numquam architecto aut nemo sed quasi perspiciatis eos ut ab totam alias ducimus assumenda delectus ipsam at vitae consequatur, rem impedit reiciendis possimus. Fugit doloremque autem quibusdam?
        Fugiat quasi obcaecati optio, aut laboriosam nulla explicabo possimus quas ea dicta! Error reiciendis minus quasi voluptate quis odit sit expedita dolorem accusantium harum rem, explicabo incidunt mollitia quae inventore!
        Blanditiis ratione iste porro nihil quasi, adipisci doloremque minima. Sed amet inventore minus blanditiis voluptas eos, sint mollitia aspernatur alias tenetur, rerum corporis saepe consectetur quidem eius qui? Dolorum, dolor.
        Magni neque, iure deleniti sit mollitia modi animi corrupti officia ab facere? Similique asperiores neque et iure optio nemo commodi maxime minima expedita alias facilis tempore dolorem, rem impedit cupiditate?
        Vel sequi praesentium aut corporis et nesciunt porro a odio? Beatae, omnis. Dignissimos, ipsam omnis labore suscipit laudantium, rem voluptatem perferendis quo ducimus tempore deleniti? Delectus commodi quae quod voluptate.
        Dicta earum necessitatibus odit rerum culpa impedit illo? Suscipit optio id error officia porro velit autem est magnam praesentium culpa? Doloribus, possimus dolores voluptatibus deserunt culpa nam laudantium quod consequatur!
        Eos veniam vel dolorum recusandae repudiandae aut voluptate optio fuga repellendus velit, ut quisquam exercitationem doloremque veritatis ex cupiditate sunt autem repellat voluptatibus eaque consequatur illum incidunt iure! Accusamus, doloribus.
        Earum tenetur architecto optio doloribus ipsa consequatur. Temporibus laborum porro pariatur molestiae. Fugiat totam inventore dolorum tenetur accusantium nobis, sunt quas accusamus quasi laboriosam? Assumenda earum tenetur nesciunt eveniet quia!
        Mollitia illum voluptatem incidunt dicta assumenda ab accusantium vitae dolores molestias eos ad tempora possimus ullam perferendis impedit, neque rerum enim aut corrupti libero amet quasi consectetur doloribus pariatur! Commodi.
        Aspernatur, ipsum saepe veniam rem atque odit voluptas similique iusto laboriosam molestiae aperiam aut asperiores nulla at laborum, architecto eligendi pariatur sit id adipisci maxime nemo minus sequi. Quas, rem.
        Pariatur, accusantium? Aliquam tempora culpa necessitatibus praesentium velit. Veniam atque qui accusamus delectus animi? Culpa illum inventore iste, odit debitis molestiae eum, libero laudantium eius ducimus, laboriosam ipsam soluta fugit.
        Dolores fugit voluptas ratione soluta expedita deleniti commodi provident reprehenderit quia officia non quo debitis quas veritatis earum placeat accusamus nemo amet dolorum, asperiores ut praesentium explicabo quis nihil? Magnam.
        Assumenda dolores corporis dolorum fugiat adipisci ipsa iste! Velit nemo suscipit omnis unde reiciendis nisi tenetur maxime architecto ipsum consequuntur beatae illum alias natus, quas, modi ex nostrum a? Aliquam.
        Nulla dicta, ducimus at culpa, harum repudiandae facilis debitis voluptas voluptatem qui officiis dolor. Autem atque culpa amet aliquam perferendis nisi, molestiae error. Inventore magni tempore sequi omnis rerum numquam?
        At dolore animi voluptatibus similique assumenda minus, corrupti facilis! Omnis repellendus, sit minus veniam architecto veritatis libero impedit corporis aperiam! Atque explicabo debitis beatae laboriosam repellat odit asperiores ad cumque?
        Modi provident reiciendis, amet excepturi natus labore soluta repellendus necessitatibus tempora aliquid ex vitae sapiente saepe libero voluptates deserunt nostrum, accusantium nobis? Nemo amet culpa laudantium tenetur ipsam soluta saepe!
        Sed delectus suscipit eos id iste quia eveniet quo quos cupiditate odit et impedit eaque, blanditiis, unde odio quod similique veritatis enim? Eum, soluta! Voluptates quam ea reprehenderit nam vero?
        Sequi, culpa fuga! Officiis expedita doloribus quaerat fugit dicta eligendi libero minima quasi, sapiente sequi suscipit veniam enim beatae recusandae ab necessitatibus amet delectus aliquid illum explicabo dolor! Corrupti, perferendis.
        Numquam voluptas eveniet dolores velit vitae dolorem expedita similique illum. Ipsam numquam illo, at tenetur pariatur aspernatur molestias, inventore blanditiis rerum facere similique tempore ad consectetur, consequatur sit officia saepe.
        Dolorem beatae cumque laudantium sit vel corporis, asperiores ex perspiciatis eius nemo iste labore vero magnam perferendis accusamus tempora eum id adipisci consequatur autem, veritatis aliquam, consectetur earum! Delectus, alias?
        Vel quam nemo quia magnam cum. Saepe amet numquam earum sint assumenda molestiae architecto necessitatibus quas officiis corporis laborum, vitae, aliquid reiciendis dolorum blanditiis cupiditate ea aliquam aut. Recusandae, facere.
        Doloremque velit corporis soluta quos fugit? Consequuntur nostrum, pariatur optio debitis excepturi maxime quaerat sunt odio eos beatae quasi aliquid hic numquam, libero culpa vel exercitationem itaque, iusto suscipit totam.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quasi cumque eaque commodi, eveniet voluptas laborum quam tenetur ea architecto expedita unde delectus accusamus aut maiores, cum aperiam at distinctio?
        Quidem, deserunt provident? Non, minima minus nulla, deleniti accusamus itaque, dolores exercitationem veritatis eos excepturi quia repellendus facere necessitatibus expedita adipisci unde officia? Odit, quo quos aliquid repellat consectetur illum.
        Accusamus impedit ad ex doloribus reiciendis necessitatibus, iure, dolores velit, corrupti veritatis tenetur cupiditate minus laborum quas earum laboriosam natus nemo quod error nihil non quibusdam cum animi aliquid. Accusantium.
        Provident, obcaecati dolore numquam architecto aut nemo sed quasi perspiciatis eos ut ab totam alias ducimus assumenda delectus ipsam at vitae consequatur, rem impedit reiciendis possimus. Fugit doloremque autem quibusdam?
        Fugiat quasi obcaecati optio, aut laboriosam nulla explicabo possimus quas ea dicta! Error reiciendis minus quasi voluptate quis odit sit expedita dolorem accusantium harum rem, explicabo incidunt mollitia quae inventore!
        Blanditiis ratione iste porro nihil quasi, adipisci doloremque minima. Sed amet inventore minus blanditiis voluptas eos, sint mollitia aspernatur alias tenetur, rerum corporis saepe consectetur quidem eius qui? Dolorum, dolor.
        Magni neque, iure deleniti sit mollitia modi animi corrupti officia ab facere? Similique asperiores neque et iure optio nemo commodi maxime minima expedita alias facilis tempore dolorem, rem impedit cupiditate?
        Vel sequi praesentium aut corporis et nesciunt porro a odio? Beatae, omnis. Dignissimos, ipsam omnis labore suscipit laudantium, rem voluptatem perferendis quo ducimus tempore deleniti? Delectus commodi quae quod voluptate.
        Dicta earum necessitatibus odit rerum culpa impedit illo? Suscipit optio id error officia porro velit autem est magnam praesentium culpa? Doloribus, possimus dolores voluptatibus deserunt culpa nam laudantium quod consequatur!
        Eos veniam vel dolorum recusandae repudiandae aut voluptate optio fuga repellendus velit, ut quisquam exercitationem doloremque veritatis ex cupiditate sunt autem repellat voluptatibus eaque consequatur illum incidunt iure! Accusamus, doloribus.
        Earum tenetur architecto optio doloribus ipsa consequatur. Temporibus laborum porro pariatur molestiae. Fugiat totam inventore dolorum tenetur accusantium nobis, sunt quas accusamus quasi laboriosam? Assumenda earum tenetur nesciunt eveniet quia!
        Mollitia illum voluptatem incidunt dicta assumenda ab accusantium vitae dolores molestias eos ad tempora possimus ullam perferendis impedit, neque rerum enim aut corrupti libero amet quasi consectetur doloribus pariatur! Commodi.
        Aspernatur, ipsum saepe veniam rem atque odit voluptas similique iusto laboriosam molestiae aperiam aut asperiores nulla at laborum, architecto eligendi pariatur sit id adipisci maxime nemo minus sequi. Quas, rem.
        Pariatur, accusantium? Aliquam tempora culpa necessitatibus praesentium velit. Veniam atque qui accusamus delectus animi? Culpa illum inventore iste, odit debitis molestiae eum, libero laudantium eius ducimus, laboriosam ipsam soluta fugit.
        Dolores fugit voluptas ratione soluta expedita deleniti commodi provident reprehenderit quia officia non quo debitis quas veritatis earum placeat accusamus nemo amet dolorum, asperiores ut praesentium explicabo quis nihil? Magnam.
        Assumenda dolores corporis dolorum fugiat adipisci ipsa iste! Velit nemo suscipit omnis unde reiciendis nisi tenetur maxime architecto ipsum consequuntur beatae illum alias natus, quas, modi ex nostrum a? Aliquam.
        Nulla dicta, ducimus at culpa, harum repudiandae facilis debitis voluptas voluptatem qui officiis dolor. Autem atque culpa amet aliquam perferendis nisi, molestiae error. Inventore magni tempore sequi omnis rerum numquam?
        At dolore animi voluptatibus similique assumenda minus, corrupti facilis! Omnis repellendus, sit minus veniam architecto veritatis libero impedit corporis aperiam! Atque explicabo debitis beatae laboriosam repellat odit asperiores ad cumque?
        Modi provident reiciendis, amet excepturi natus labore soluta repellendus necessitatibus tempora aliquid ex vitae sapiente saepe libero voluptates deserunt nostrum, accusantium nobis? Nemo amet culpa laudantium tenetur ipsam soluta saepe!
        Sed delectus suscipit eos id iste quia eveniet quo quos cupiditate odit et impedit eaque, blanditiis, unde odio quod similique veritatis enim? Eum, soluta! Voluptates quam ea reprehenderit nam vero?
        Sequi, culpa fuga! Officiis expedita doloribus quaerat fugit dicta eligendi libero minima quasi, sapiente sequi suscipit veniam enim beatae recusandae ab necessitatibus amet delectus aliquid illum explicabo dolor! Corrupti, perferendis.
        Numquam voluptas eveniet dolores velit vitae dolorem expedita similique illum. Ipsam numquam illo, at tenetur pariatur aspernatur molestias, inventore blanditiis rerum facere similique tempore ad consectetur, consequatur sit officia saepe.
        Dolorem beatae cumque laudantium sit vel corporis, asperiores ex perspiciatis eius nemo iste labore vero magnam perferendis accusamus tempora eum id adipisci consequatur autem, veritatis aliquam, consectetur earum! Delectus, alias?
        Vel quam nemo quia magnam cum. Saepe amet numquam earum sint assumenda molestiae architecto necessitatibus quas officiis corporis laborum, vitae, aliquid reiciendis dolorum blanditiis cupiditate ea aliquam aut. Recusandae, facere.
        Doloremque velit corporis soluta quos fugit? Consequuntur nostrum, pariatur optio debitis excepturi maxime quaerat sunt odio eos beatae quasi aliquid hic numquam, libero culpa vel exercitationem itaque, iusto suscipit totam.</p>
</div>';

// on active l'onglet du menu 'nav' correspondant à la page en cours 
// 0 = index.php, 1 = playground.php, 2 = activities.php, 3 = help.php
$active = [false, true, false, false];

// [optionnel] fichier de script externe 
$script = 'playground.js';

// 2) récupération des paramètres sous forme de tableau, pour améliorer la lisibilité 
$params = [$page_title, $main_content, $active, $script];

// 3) affichage de la page web paramétrée 
// on utilise ici un 'splat operator' ("...") : transforme le tableau $params en liste d'arguments 
echo (createWebPage(...$params));
