// --------------------[ SCRIPT - JS ]--------------------

/*
|---------------------------------------------------------------------------------------------------
|   GET CITY
|---------------------------------------------------------------------------------------------------
|   Fonction qui permet de remplir automatiquement le champ "ville" du formulaire "update_usr_info" 
|   en fonction du champ "code postal", via une requête AJAX (API du gouvernement). 
*/

function getCity() {
    // ----------[ variables raccourcies ]----------
    let zipCode = document.getElementById("usr_zipcode").value;
    let usrCity = document.getElementById("usr_city");
    let usrCityVal = usrCity.value;

    // ----------[ requête AJAX ]----------
    let oXHR = new XMLHttpRequest();
    oXHR.open("get", "https://geo.api.gouv.fr/communes?codePostal=" + zipCode);
    oXHR.send();
    oXHR.addEventListener("readystatechange", function () {
        // si tout se passe correctement...
        if (oXHR.status === 200 && oXHR.readyState === 4) {
            // ... on récupère le retour de la requête AJAX sous forme d'un objet "oData"
            let oData = JSON.parse(oXHR.responseText);

            // ----------[ oData ]----------
            /* 
            3 cas de figure possibles pour "oData" :
                1) < 1      : le code postal est erroné, il ne retourne aucune ville
                2) === 1    : le code postal ne correspond qu'à 1 seule et unique ville
                3) > 1      : un code postal pour plusieurs villes
            
            Au chargement de la page "account.php", "usr_city" est un <input> ; Donc si on choisit 
            un code postal qui renvoie plusieurs villes, on doit d'abord le convertir en <select>. 
            
            On doit aussi faire l'inverse (<select> vers <input>) si on a d'abord choisi un code postal
            qui renvoie plusieurs villes puis qu'on revient vers un code postal unique ou erroné.
            
            On crée donc une fonction "switchElements" qui va chercher la balise avec l'id "#usr_city"
            et qui permet de modifier son type vers ce qu'on veut (via le paramètre "newElementType").
            */
            function switchElements(newElementType) {
                // on crée un nouvel élément du type qu'on souhaite
                newElement = document.createElement(newElementType);
                // on remplace "#usr_city" avec le nouvel élément
                usrCity.replaceWith(newElement);
                // on rajoute les attributs nécessaires au nouvel élément ("classes" bootstrap, "id" et "name")
                newElement.setAttribute("class", "form-control valid-effect");
                newElement.setAttribute("id", "usr_city");
                newElement.setAttribute("name", "usr_city");
                // si l'élément est <input> on lui rajoute l'attribut "readonly"
                if (newElementType === "input") {
                    newElement.readOnly = true;
                }
            }
            // 1) "oData" < 1
            if (oData.length < 1) {
                // si "#usr_city" est <select> on le switche d'abord vers <input> et on indique un message d'erreur code postal
                if (usrCity.tagName === "SELECT") {
                    switchElements("input");
                    newElement.value = "Code postal non valide";
                    // sinon on indique directement un message d'erreur code postal
                } else {
                    usrCity.value = "Code postal non valide";
                }
                // 2) "oData" === 1
            } else if (oData.length === 1) {
                // si "#usr_city" est <select> on le switche d'abord vers <input> et on remplit la ville
                if (usrCity.tagName === "SELECT") {
                    switchElements("input");
                    newElement.value = oData[0].nom;
                    // sinon on remplit directement la ville
                } else {
                    usrCity.value = oData[0].nom;
                }
                // 3) "oData" > 1
            } else {
                // on switche direct vers <select>
                switchElements("select");
                // on définit une variable qui servira à créer les <option> avec les noms des villes
                let oOption;
                // puis on boucle pour placer chaque ville retournée dans un <option>
                for (let i = 0; i < oData.length; i++) {
                    oOption = document.createElement("option");
                    // pour chaque <option>, on ajoute le nom de la ville aux attributs 'value' et 'textcontent'
                    oOption.value = oData[i].nom;
                    oOption.textContent = oData[i].nom;
                    // on ajoute chaque <option> à la nouvelle balise <select> "#usr_city"
                    newElement.appendChild(oOption);
                    // enfin, pour que le nom de la ville soit directement sélectionné au chargement de la page, on donne sa valeur à la nouvelle balise <select> "#usr_city"
                    if (oData[i].nom == usrCityVal) {
                        newElement.value = usrCityVal;
                    }
                }
            }
        }
    });
}

// on lance "getCity" au chargement de page pour adapter le champ "ville" en fonction du code postal (liste déroulante si villes multiples)
window.onload = getCity;

// on branche un écouteur d'évènements au <input> "#usr_zipcode" pour qu'il mette à jour le champ "ville" dès que le focus passe à un autre élément
document.getElementById("usr_zipcode").addEventListener("blur", getCity);

/*
|---------------------------------------------------------------------------------------------------
|   UPDATE_USR_IMG - 1/2 : mise à jour de la photo
|---------------------------------------------------------------------------------------------------
|   ----------[ V1 ]----------
|   En cas de modification de "#usr_img", on veut que le formulaire soit posté immédiatement (sans bouton de validation).
|   Le formulaire a donc 2 <submit> : 
|       - le premier est 'hidden' et lié à la photo par l'intermédiaire son <label> ; c'est celui qu'on va utiliser ici 
|       - le second est un <button type="submit"> classique ; il servira à la suppression de l'image (dans la fonction suivante)
|
|   On écoute le formulaire et on le submit directement si l'évènement "change" survient (= quand on modifie l'image). 
|
|   ----------[ V2 ]----------
|   Dans la V1, après traitement du formulaire ("update_usr_img.php"), on procédait à une redirection vers "account.php"
|   avec un message d'information. 
|
|   Maintenant, grâce à AJAX / jQuery, au lieu de recharger la page entière, on ne recharge que la <div> 
|   contenant la photo, avec une animation pour souligner la modification (ou la suppression). 
*/

// ----------[ V1 ]----------
// document.getElementById("update_usr_img").addEventListener("change", function () {
//     this.submit();
// });

// ----------[ V2 ]----------
$(document).ready(function () {
    $(function () {
        // quand modif de l'image, avant de submit le formulaire...
        $("#update_usr_img").change(function (e) {
            // on stoppe la soumission
            e.preventDefault();
            let form = $(this);
            // requête AJAX vers la page de traitement du formulaire
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                // 3 prochaines lignes : spécifiques pour envoi d'objet type 'images'
                data: new FormData(this),
                processData: false,
                contentType: false,
                // si tout s'est passé correctement on affiche la <div> mise à jour avec un effet de transition
                success: function () {
                    $("#usr_pic").fadeOut(800, function () {
                        $(form).load("account.php" + " #reload_usr_img");
                        $(form).fadeIn().delay(800);
                    });
                },
            });
        });
    });
});

/*
|---------------------------------------------------------------------------------------------------
|   UPDATE_USR_IMG - 2/2 : suppression de la photo
|---------------------------------------------------------------------------------------------------
|   Notre formulaire a donc 2 <submit> : 
|       - le 1er quand on "change" la photo (fonction précédente) : cela envoie les données de l'image pour traitement
|       - le 2nd quand on clique sur le bouton "Supprimer", n'envoie aucune donnée ; c'est celui qu'on va utiliser ici 
|
|   Le script de traitement reçoit donc soit une image, soit rien : dans ce cas-là, on met "NULL" 
|   dans le tableau de paramètres de la requête SQL afin que l'image soit supprimée. 
|
|   Puis comme précédemment, une petite animation pour valider la suppression de l'image. 
*/

$(document).ready(function () {
    $(function () {
        // quand on clique sur le bouton pour suppr l'image, avant de submit le formulaire...
        $("#update_usr_img").submit(function (e) {
            // on stoppe la soumission
            e.preventDefault();
            let form = $(this);
            // requête AJAX vers la page de traitement du formulaire
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                // la ligne suivante pour les envois de données de type 'texte'
                data: form.serialize(),
                // si tout s'est passé correctement, on affiche la <div> mise à jour avec un effet de transition
                success: function () {
                    $("#usr_pic").fadeOut(800, function () {
                        $(form).load("account.php" + " #reload_usr_img");
                        $(form).fadeIn().delay(800);
                    });
                },
            });
        });
    });
});

/*
|---------------------------------------------------------------------------------------------------
|   UPDATE_USR_INFO 
|---------------------------------------------------------------------------------------------------
|   Submit du formulaire "update_usr_info", avec reload automatique de la <div> du formulaire uniquement (AJAX / jQuery). 
|   
|   Pour l'animation visuelle qui marque la modification, on ajoute la "class" Bootstrap "is-valid" 
|   (= <input> encadrés de vert + coche de validation verte) pendant 1 seconde, puis on la retire. 
*/

$(document).ready(function () {
    $(function () {
        // quand on clique sur le bouton pour updater les infos perso, avant de submit le formulaire...
        $("#update_usr_info").submit(function (e) {
            // on stoppe la soumission
            e.preventDefault();
            let form = $(this);
            // requête AJAX vers la page de traitement du formulaire
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                // la ligne suivante pour les envois de données de type 'texte'
                data: form.serialize(),
                // si tout s'est passé correctement, on affiche la <div> mise à jour avec un effet de transition
                success: function () {
                    $(".valid-effect").addClass("is-valid");
                    setTimeout(() => {
                        $(".valid-effect").removeClass("is-valid");
                    }, 1000);
                },
            });
        });
    });
});
