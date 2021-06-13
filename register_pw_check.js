// ----------[ SCRIPT - JS ]---------- 
// avant envoi du formulaire d'inscription ou de modification du mot de passe, 
// on vérifie si les strings des 2 champs mot de passe sont bien identiques 

// on branche un écouteur d'évènements au formulaire "register" de la page 'index1.php'
// document.getElementById("register").addEventListener(
// !! cela provoque une erreur "this.submit is not a function" 
// donc on branche un écouteur d'évènements au 1er formulaire trouvé ("[0]") de la page 'index1.php 
document.getElementsByTagName('form')[0].addEventListener(
    'submit',
    function (evt) {
        // on empêche l'envoi direct du formulaire avant vérif 
        evt.preventDefault();
        // on teste si les mots de passe sont équivalents
        if (document.getElementById('usr_pass').value === document.getElementById('check').value) {
            this.submit();
        } else {
            alert('Attention : les mots de passe ne correspondent pas !');
        }
    },
    false
);