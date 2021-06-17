<html>

<head>
</head>

<body>

    <form id="form1" action="test2.php" method="POST">
        <div id="test">
            <div id="zip">
                <label>code postal</label><br>
                <input name="zip">
            </div>

            <br>

            <div id="city">
                <label>ville</label><br>
                <input name="city">
            </div>

            <br>

            <div>
                <label>submit</label><br>
                <button type="submit">Envoyer</button>
            </div>
        </div>
    </form>

    <form id="form2" action="test3.php" method="POST">
        <div id="name">
            <label>nom</label><br>
            <input name="name">
        </div>

        <br>

        <div id="fname">
            <label>prenom</label><br>
            <input name="fname">
        </div>

        <br>

        <div>
            <label>submit</label><br>
            <button type="submit">Envoyer</button>
        </div>
    </form>

    <a id="test-reload-btn" href="test.php">test-reload-div</a>


    <!-- ----------[ scripts ]----------  -->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        // -----------------------------------------------------------------------------------------------------
        // JQUERY - poste form + reload seulement 1 div (pas toute la page)

        $(document).ready(function() {
            $(function() {
                $('#form1').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    // var post_url = form.attr('action');
                    // var post_data = form.serialize();
                    // On peut ajouter une image de chargement pour faire patienter l'internaute
                    // $('#loader3', form).html('<img src="img/jamproject-64.png" />Please wait...');
                    //Appel AJAX
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(msg) {
                            //Affichage du formulaire avec un effet
                            $(form).load('test.php' + " #test")
                            console.log('test');
                            // $(form).fadeOut(800, function() {
                            // form.html(msg).fadeIn().delay(2000);
                            // $(form).fadeIn().delay(1000);
                            // $(form).fadeIn().delay(1000);

                            // });
                        }
                    });
                });
            });
        });
        // -----------------------------------------------------------------------------------------------------





        // -----------------------------------------------------------------------------------------------------
        // JQUERY - reload seulement 1 div (pas toute la page)

        $('#test-reload-btn').click(function() {
            $("#zip").load('test.php' + " #zip");
            return false;
        });
        // -----------------------------------------------------------------------------------------------------





        // -----------------------------------------------------------------------------------------------------
        // AJAX - remplir ville en fonction du code postal 

        // function getCity() {
        //     document.getElementById('city').value = "";
        //     let sZip = document.getElementById('zip').value;
        //     let oXHR = new XMLHttpRequest;
        //     oXHR.open('get', 'https://geo.api.gouv.fr/communes?codePostal=' + sZip, true);
        //     oXHR.send();
        //     oXHR.addEventListener(
        //         'readystatechange',
        //         function () {
        //             if (oXHR.status === 200 && oXHR.readyState === 4) {
        //                 let oData = JSON.parse(oXHR.responseText);
        //                 document.getElementById('city').value = oData[0]['nom'];
        //             }
        //         }
        //     );
        // };

        // document.getElementById('zip').addEventListener('change', getCity);
        // -----------------------------------------------------------------------------------------------------
    </script>

</body>

</html>