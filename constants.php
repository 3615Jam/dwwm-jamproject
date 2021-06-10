<?php

// ----------[ accès BDD ]---------- 
const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const DB = 'jamproject';


// ----------[ codes information ]---------- 
// --- liés à USER : 
// création user ok 
const U1 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> L\'utilisateur a été crée avec succès.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// pb de connexion - mail ou mot de passe erroné
const U2 = '<div class="text-center my-5 alert alert-danger alert-dismissible fade show" role="alert"><strong>Oups !</strong> Le mail ou le mot de passe est erroné.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// connexion requise 
const U3 = '<div class="text-center my-5 alert alert-warning alert-dismissible fade show" role="alert"><strong>Attention !</strong> Vous devez d\'abord vous connecter pour accéder à cette page.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// déconnexion avec succès 
const U4 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> Vous êtes bien déconnecté.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
// mail déjà utilisé 
const U5 = '<div class="text-center my-5 alert alert-warning alert-dismissible fade show" role="alert"><strong>Attention !</strong> Cet email est déjà utilisé.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

// --- liés à BDD : 
// aucune donnée à afficher (tables BDD)
const B1 = '<div class="text-center"><div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Oups !</strong> Il n\'y a rien à afficher ici.</div><a class="justify-content-center btn btn-info" href="bo.php">Retour au back-office</a></div>';
// table mise à jour succès 
const B2 = '<div class="text-center my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>Super !</strong> La table a bien été mise à jour<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
