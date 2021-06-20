<?php
// ----------[ imports ]---------- 
include_once('constants.php');

// ----------[ démarrage ou récupération de session ]---------- 
session_start();
$connected = false;
if (isset($_SESSION['connected']) && ($_SESSION['connected'])) {
    $connected = $_SESSION['connected'];
}
?>

<!-- ----------[ html ]---------- -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWWM - Jam Project | Accueil</title>
    <link rel="icon" type="ico" href="img/jamproject-64.png">
    <!-- ----------[ bootstrap - css ]---------- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- ----------[ bootstrap - js ]---------- -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- ----------[ custom - css ]---------- -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- ----------[ custom - js ]---------- -->
    <!-- js - vérification de la concordance du mot de passe lors d'une inscription -->
    <script defer src="index_modal_pw_check.js"></script>
</head>

<body class="container-fluid">

    <header class="row align-items-center text-center">
        <div id="logo" class="col-2">
            <img src="img/jamproject-128.png" alt="logo jam project">
        </div>
        <div id="main_title" class="col-8">

            <h1 class="m-5">Bienvenue sur Jam Project !</h1>

            <nav>
                <ul class="d-flex justify-content-around text-decoration-none">
                    <li><a href="index1.php" role="button" class="btn btn-outline-success btn-sm active">Accueil</a></li>
                    <li><a href="news.php" role="button" class="btn btn-outline-success btn-sm">Actualités</a></li>
                    <li><a href="activities.php" role="button" class="btn btn-outline-success btn-sm">Activités</a></li>
                    <li><a href="#" role="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div id="login_zone" class="col-2">
            <div>
                <?php
                // ----------[ contenu variable : login zone ]---------- 
                // en fonction du statut de $connected, on n'affiche pas les mêmes boutons dans cette zone :
                // user déconnecté : on affiche les boutons "inscription" et "connexion"
                // user connecté : on affiche les boutons "compte" et "déconnexion"

                // boutons à afficher quand user co 
                $buttons_co = '
                <div class="m-3">
                    <h5>Accès à mon compte</h5>
                    <a class="btn btn-info btn-lg" href="account.php" role="button">Compte</a>
                </div>
                <div class="m-3">
                    <h5>Deconnexion</h5>
                    <a class="btn btn-danger btn-lg" href="logout.php" role="button">A bientôt</a>
                </div>
                ';

                // boutons à afficher quand user déco 
                $buttons_deco = '
                <div class="m-3">
                    <h5>Nouvel utilisateur ?</h5>
                    <a class="btn btn-success btn-lg" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
                </div>
                <div class="m-3">
                    <h5>Déjà inscrit ?</h5>
                    <a class="btn btn-info btn-lg" href="#" role="button" data-toggle="modal" data-target="#login">Connexion</a>
                </div>
                ';

                // affichage des boutons adéquats via un ternaire 
                echo ($connected ? $buttons_co : $buttons_deco);
                ?>
            </div>
        </div>
    </header>

    <main>
        <div>
            <?php
            // ----------[ messages d'information en cas de redirection depuis une autre page ]---------- 
            if (isset($_GET['c']) && !empty($_GET['c'])) {
                switch ($_GET['c']) {
                    case '1':
                        echo U1;
                        break;
                    case '2':
                        echo U2;
                        break;
                    case '3':
                        echo U3;
                        break;
                    case '4':
                        echo U4;
                        break;
                    case '5':
                        echo U5;
                        break;
                    default:
                        echo 'Rien à signaler';
                }
            }
            ?>
        </div>
        <section class="row align-items-center text-center">
            <aside class="col-2">
                <p>test aside</p>
            </aside>
            <article class="col-10">
                <p>test article</p>
                <!-- ----------[ bootstrap - carousel ]---------- -->
                <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/jamproject-512.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/jamproject-512.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/jamproject-512.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> -->
            </article>
        </section>
    </main>

    <footer class="text-center">
        <p>© 2021 - Jam Project</p>
    </footer>

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
                            <label for="mail">Email : </label>
                            <input class="form-control" type="email" name="mail" id="mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe : </label>
                            <input class="form-control" type="password" name="pass" id="pass" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                        </div>
                        <div class="form-group">
                            <label for="check">Vérification du mot de passe : </label>
                            <input class="form-control" type="password" name="check" id="check" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ----------[ modal connexion ]---------- -->
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
                            <label for="mail">Email : </label>
                            <input class="form-control" type="email" name="mail" id="mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe : </label>
                            <input class="form-control" type="password" name="pass" id="pass" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!.@#$%&*_=+-]).{8,}" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole parmi ceux-ci : ! . @ # $ % & * _ = + - " required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="Se connecter">
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
                            <label for="mail">Email : </label>
                            <input class="form-control" type="email" name="mail" id="mail" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                        <div class="form-group">
                            <label for="request">Demande : </label>
                            <textarea class="form-control" type="text" name="request" id="request" rows="8" placeholder="Comment peut-on vous aider ?" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="submit" class="btn btn-primary" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>






























































































<!--                                                                                                                                                                       










DDDDDDDDDDDDD                                                                                                                                                         
D::::::::::::DDD                                                                                                                                                      
D:::::::::::::::DD                                                                                                                                                    
DDD:::::DDDDD:::::D                                                                                                                                                   
  D:::::D    D:::::D  aaaaaaaaaaaaa  rrrrr   rrrrrrrrr      ooooooooooo   nnnn  nnnnnnnn        ssssssssss                                                            
  D:::::D     D:::::D a::::::::::::a r::::rrr:::::::::r   oo:::::::::::oo n:::nn::::::::nn    ss::::::::::s                                                           
  D:::::D     D:::::D aaaaaaaaa:::::ar:::::::::::::::::r o:::::::::::::::on::::::::::::::nn ss:::::::::::::s                                                          
  D:::::D     D:::::D          a::::arr::::::rrrrr::::::ro:::::ooooo:::::onn:::::::::::::::ns::::::ssss:::::s                                                         
  D:::::D     D:::::D   aaaaaaa:::::a r:::::r     r:::::ro::::o     o::::o  n:::::nnnn:::::n s:::::s  ssssss                                                          
  D:::::D     D:::::D aa::::::::::::a r:::::r     rrrrrrro::::o     o::::o  n::::n    n::::n   s::::::s                                                               
  D:::::D     D:::::Da::::aaaa::::::a r:::::r            o::::o     o::::o  n::::n    n::::n      s::::::s                                                            
  D:::::D    D:::::Da::::a    a:::::a r:::::r            o::::o     o::::o  n::::n    n::::nssssss   s:::::s                                                          
DDD:::::DDDDD:::::D a::::a    a:::::a r:::::r            o:::::ooooo:::::o  n::::n    n::::ns:::::ssss::::::s                                                         
D:::::::::::::::DD  a:::::aaaa::::::a r:::::r            o:::::::::::::::o  n::::n    n::::ns::::::::::::::s                                                          
D::::::::::::DDD     a::::::::::aa:::ar:::::r             oo:::::::::::oo   n::::n    n::::n s:::::::::::ss                                                           
DDDDDDDDDDDDD         aaaaaaaaaa  aaaarrrrrrr               ooooooooooo     nnnnnn    nnnnnn  sssssssssss                                                             
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                  dddddddd                                                                                                            
        CCCCCCCCCCCCC                             d::::::d                                                                                                            
     CCC::::::::::::C                             d::::::d                                                                                                            
   CC:::::::::::::::C                             d::::::d                                                                                                            
  C:::::CCCCCCCC::::C                             d:::::d                                                                                                             
 C:::::C       CCCCCC   ooooooooooo       ddddddddd:::::d     eeeeeeeeeeee    uuuuuu    uuuuuu rrrrr   rrrrrrrrr       ssssssssss                                     
C:::::C               oo:::::::::::oo   dd::::::::::::::d   ee::::::::::::ee  u::::u    u::::u r::::rrr:::::::::r    ss::::::::::s                                    
C:::::C              o:::::::::::::::o d::::::::::::::::d  e::::::eeeee:::::eeu::::u    u::::u r:::::::::::::::::r ss:::::::::::::s                                   
C:::::C              o:::::ooooo:::::od:::::::ddddd:::::d e::::::e     e:::::eu::::u    u::::u rr::::::rrrrr::::::rs::::::ssss:::::s                                  
C:::::C              o::::o     o::::od::::::d    d:::::d e:::::::eeeee::::::eu::::u    u::::u  r:::::r     r:::::r s:::::s  ssssss                                   
C:::::C              o::::o     o::::od:::::d     d:::::d e:::::::::::::::::e u::::u    u::::u  r:::::r     rrrrrrr   s::::::s                                        
C:::::C              o::::o     o::::od:::::d     d:::::d e::::::eeeeeeeeeee  u::::u    u::::u  r:::::r                  s::::::s                                     
 C:::::C       CCCCCCo::::o     o::::od:::::d     d:::::d e:::::::e           u:::::uuuu:::::u  r:::::r            ssssss   s:::::s                                   
  C:::::CCCCCCCC::::Co:::::ooooo:::::od::::::ddddd::::::dde::::::::e          u:::::::::::::::uur:::::r            s:::::ssss::::::s                                  
   CC:::::::::::::::Co:::::::::::::::o d:::::::::::::::::d e::::::::eeeeeeee   u:::::::::::::::ur:::::r            s::::::::::::::s                                   
     CCC::::::::::::C oo:::::::::::oo   d:::::::::ddd::::d  ee:::::::::::::e    uu::::::::uu:::ur:::::r             s:::::::::::ss                                    
        CCCCCCCCCCCCC   ooooooooooo      ddddddddd   ddddd    eeeeeeeeeeeeee      uuuuuuuu  uuuurrrrrrr              sssssssssss                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
FFFFFFFFFFFFFFFFFFFFFF                                                                                                                                           
F::::::::::::::::::::F                                                                                                                                           
F::::::::::::::::::::F                                                                                                                                           
FF::::::FFFFFFFFF::::F                                                                                                                                           
  F:::::F       FFFFFFooooooooooo   rrrrr   rrrrrrrrr       eeeeeeeeeeee  vvvvvvv           vvvvvvv eeeeeeeeeeee    rrrrr   rrrrrrrrr                            
  F:::::F           oo:::::::::::oo r::::rrr:::::::::r    ee::::::::::::ee v:::::v         v:::::vee::::::::::::ee  r::::rrr:::::::::r                           
  F::::::FFFFFFFFFFo:::::::::::::::or:::::::::::::::::r  e::::::eeeee:::::eev:::::v       v:::::ve::::::eeeee:::::eer:::::::::::::::::r                          
  F:::::::::::::::Fo:::::ooooo:::::orr::::::rrrrr::::::re::::::e     e:::::e v:::::v     v:::::ve::::::e     e:::::err::::::rrrrr::::::r                         
  F:::::::::::::::Fo::::o     o::::o r:::::r     r:::::re:::::::eeeee::::::e  v:::::v   v:::::v e:::::::eeeee::::::e r:::::r     r:::::r                         
  F::::::FFFFFFFFFFo::::o     o::::o r:::::r     rrrrrrre:::::::::::::::::e    v:::::v v:::::v  e:::::::::::::::::e  r:::::r     rrrrrrr                         
  F:::::F          o::::o     o::::o r:::::r            e::::::eeeeeeeeeee      v:::::v:::::v   e::::::eeeeeeeeeee   r:::::r                                     
  F:::::F          o::::o     o::::o r:::::r            e:::::::e                v:::::::::v    e:::::::e            r:::::r                                     
FF:::::::FF        o:::::ooooo:::::o r:::::r            e::::::::e                v:::::::v     e::::::::e           r:::::r                                     
F::::::::FF        o:::::::::::::::o r:::::r             e::::::::eeeeeeee         v:::::v       e::::::::eeeeeeee   r:::::r                                     
F::::::::FF         oo:::::::::::oo  r:::::r              ee:::::::::::::e          v:::v         ee:::::::::::::e   r:::::r                                     
FFFFFFFFFFF           ooooooooooo    rrrrrrr                eeeeeeeeeeeeee           vvv            eeeeeeeeeeeeee   rrrrrrr                                     
                                                                                                                                                                
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      

     


MMMMMMMM               MMMMMMMM                                                              iiii                                            
M:::::::M             M:::::::M                                                             i::::i                                           
M::::::::M           M::::::::M                                                              iiii                                            
M:::::::::M         M:::::::::M                                                                                                              
M::::::::::M       M::::::::::M    eeeeeeeeeeee    rrrrr   rrrrrrrrr       cccccccccccccccciiiiiii                                           
M:::::::::::M     M:::::::::::M  ee::::::::::::ee  r::::rrr:::::::::r    cc:::::::::::::::ci:::::i                                           
M:::::::M::::M   M::::M:::::::M e::::::eeeee:::::eer:::::::::::::::::r  c:::::::::::::::::c i::::i                                           
M::::::M M::::M M::::M M::::::Me::::::e     e:::::err::::::rrrrr::::::rc:::::::cccccc:::::c i::::i                                           
M::::::M  M::::M::::M  M::::::Me:::::::eeeee::::::e r:::::r     r:::::rc::::::c     ccccccc i::::i                                           
M::::::M   M:::::::M   M::::::Me:::::::::::::::::e  r:::::r     rrrrrrrc:::::c              i::::i                                           
M::::::M    M:::::M    M::::::Me::::::eeeeeeeeeee   r:::::r            c:::::c              i::::i                                           
M::::::M     MMMMM     M::::::Me:::::::e            r:::::r            c::::::c     ccccccc i::::i                                           
M::::::M               M::::::Me::::::::e           r:::::r            c:::::::cccccc:::::ci::::::i                                          
M::::::M               M::::::M e::::::::eeeeeeee   r:::::r             c:::::::::::::::::ci::::::i                                          
M::::::M               M::::::M  ee:::::::::::::e   r:::::r              cc:::::::::::::::ci::::::i                                          
MMMMMMMM               MMMMMMMM    eeeeeeeeeeeeee   rrrrrrr                cccccccccccccccciiiiiiii       







                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                                                            
LLLLLLLLLLL                                                  lllllll                                                                                                  
L:::::::::L                                                  l:::::l                                                                                                  
L:::::::::L                                                  l:::::l                                                                                                  
LL:::::::LL                                                  l:::::l                                                                                                  
  L:::::L                   eeeeeeeeeeee        ssssssssss    l::::lyyyyyyy           yyyyyyy                                                                         
  L:::::L                 ee::::::::::::ee    ss::::::::::s   l::::l y:::::y         y:::::y                                                                          
  L:::::L                e::::::eeeee:::::eess:::::::::::::s  l::::l  y:::::y       y:::::y                                                                           
  L:::::L               e::::::e     e:::::es::::::ssss:::::s l::::l   y:::::y     y:::::y                                                                            
  L:::::L               e:::::::eeeee::::::e s:::::s  ssssss  l::::l    y:::::y   y:::::y                                                                             
  L:::::L               e:::::::::::::::::e    s::::::s       l::::l     y:::::y y:::::y                                                                              
  L:::::L               e::::::eeeeeeeeeee        s::::::s    l::::l      y:::::y:::::y                                                                               
  L:::::L         LLLLLLe:::::::e           ssssss   s:::::s  l::::l       y:::::::::y                                                                                
LL:::::::LLLLLLLLL:::::Le::::::::e          s:::::ssss::::::sl::::::l       y:::::::y                                                                                 
L::::::::::::::::::::::L e::::::::eeeeeeee  s::::::::::::::s l::::::l        y:::::y                                                                                  
L::::::::::::::::::::::L  ee:::::::::::::e   s:::::::::::ss  l::::::l       y:::::y                                                                                   
LLLLLLLLLLLLLLLLLLLLLLLL    eeeeeeeeeeeeee    sssssssssss    llllllll      y:::::y                                                                                    
                                                                          y:::::y                                                                                     
                                                                         y:::::y                                                                                      
                                                                        y:::::y                                                                                       
                                                                       y:::::y                                                                                        
                                                                      yyyyyyy                                                                                         
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      
                                                                                                                                                                      




                                                                                                                                                                       -->