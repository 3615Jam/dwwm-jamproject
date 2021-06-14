// ----------[ SCRIPT - JS ]---------- 

// ----------[ vérif concordance password ]---------- 
// avant envoi du formulaire d'inscription ou de modification du mot de passe, 
// on vérifie si les strings des 2 champs 'mot de passe' sont bien identiques 
function pw_check(evt) {
    // on empêche l'évènement (= l'envoi direct du formulaire avant vérif) de se produire 
    evt.preventDefault();
    // on vérifie si les mots de passe coincident 
    if (document.getElementById('usr_pass').value === document.getElementById('check').value) {
        this.submit();
    } else {
        alert('Attention : les mots de passe ne correspondent pas !');
    }
}

// on branche un écouteur d'évènements au formulaire contenu dans la div dont l'ID est "register" (toutes pages)
document.querySelector('#register form').addEventListener('submit', pw_check); 

// on branche un écouteur d'évènements au formulaire contenu dans la div dont l'ID est "update_usr_pass" (account.php)
document.querySelector('#update_usr_pass form').addEventListener('submit', pw_check); 

// ----------[ envoi auto formulaire 'update_usr_img' ]---------- 
// en cas de modification de usr_img, on veut que le formulaire soit post immédiatement (pas de bouton de validation)
document.getElementById('update_usr_img').addEventListener('change', function() {this.submit()}); 