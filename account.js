// ----------[ SCRIPT - JS ]----------

// ----------[ CITY : remplissage auto ville en fonction du code postal ]----------
function getCity() {
    // variables raccourcies
    let usrCity = document.getElementById("usr_city");
    let zipCode = document.getElementById("usr_zipcode").value;

    // requête AJAX
    let oXHR = new XMLHttpRequest();
    oXHR.open("get", "https://geo.api.gouv.fr/communes?codePostal=" + zipCode, true);
    oXHR.send();
    oXHR.addEventListener("readystatechange", function () {
        if (oXHR.status === 200 && oXHR.readyState === 4) {
            // on récupère les retour de la requête AJAX sous forme d'un objet 'oData'
            let oData = JSON.parse(oXHR.responseText);

            /* 
                3 cas de figure possibles pour 'oData' :
                    1) < 1      : le code postal est erroné, il ne retourne aucune ville
                    2) === 1    : le code postal ne correspond qu'à 1 seule et unique ville
                    3) > 1      : un code postal pour plusieurs villes
                
                au chargement de la page 'account.php', 'usr_city' est un 'input'
                donc si on choisit un code postal qui contient plusieurs villes,
                on doit d'abord convertir le 'input' en 'select'
                et on doit faire l'inverse ('select' en 'input') si on a d'abord choisi un code postal
                qui contient plusieurs villes puis qu'on revient vers un code postal unique ou erroné

                on crée donc une fonction 'switchElements' qui va chercher la balise avec l'id 'usr_city'
                et qui switche son type entre 'input' et 'select'
            */
            function switchElements(newElementType) {
                newElement = document.createElement(newElementType);
                usrCity.replaceWith(newElement);
                newElement.setAttribute("class", "form-control");
                newElement.setAttribute("id", "usr_city");
                newElement.setAttribute("name", "usr_city");
                if (newElementType === "input") {
                    newElement.readOnly = true;
                }
            }
            // 1) oData < 1
            if (oData.length < 1) {
                if (usrCity.tagName === "SELECT") {
                    switchElements("input");
                    newElement.value = "Code postal non valide";
                } else {
                    usrCity.value = "Code postal non valide";
                }
                // 2) oData === 1
            } else if (oData.length === 1) {
                if (usrCity.tagName === "SELECT") {
                    switchElements("input");
                    newElement.value = oData[0].nom;
                } else {
                    usrCity.value = oData[0].nom;
                }
                // 3) oData > 1
            } else {
                switchElements("select");
                // on définit une variable qui servira à créer les options avec les noms des villes
                let oOption;
                // puis on boucle pour placer chaque ville retournée dans un 'option'
                for (let i = 0; i < oData.length; i++) {
                    oOption = document.createElement("option");
                    // on récupère le code pays qu'on mettra dans 'oOption'
                    oOption.value = oData[i].nom;
                    oOption.textContent = oData[i].nom;
                    newElement.appendChild(oOption);
                }
            }
        }
    });
}

// on branche un écouteur d'évènements au input 'usr_zipcode' (account.php)
document.getElementById("usr_zipcode").addEventListener("blur", getCity);

// ----------[ USR_IMG UPDATE : envoi + refresh div auto formulaire 'update_usr_img' ]----------
// en cas de modification de usr_img, on veut que le formulaire soit post immédiatement (pas de bouton de validation)

// ----------[ V1 : eventListener sur la modification du 'input' "usr_img" ]----------
// document.getElementById("update_usr_img").addEventListener("change", function () {
//     this.submit();
// });

// ----------[ V2 : submit du form + reload de sa div uniquement via AJAX / jQuery ]----------
$(document).ready(function () {
    $(function () {
        $("#update_usr_img").change(function (e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                // la ligne suivante pour les envois de données de type 'texte'
                // data: $(this).serialize(),
                // les 3 lignes suivantes pour les envois de données type 'images'
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (msg) {
                    $(form).load("account.php" + " #reload");
                },
            });
        });
    });
});
