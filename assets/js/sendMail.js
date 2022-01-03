$(document).ready(function () {

    // Fonction pour supprimer le bloc alert-success
    function envoiSuccess() {
        $('.alert-success').fadeOut(1000, function () {
            $(this).remove();
        });

    }

    // Pour le bloc .formulaire
    $('#envoyer').click(function (e) {

        e.preventDefault();

        // // -- Réinitialisation des erreurs
        $('.formulaire .is-invalid').removeClass('is-invalid');
        $('.formulaire .invalid-feedback').remove();

        // -- Initialisation des variables
        const nom = $('.formulaire input[name="nom_contact"]');
        const prenom = $('.formulaire input[name="prenom_contact"]');
        const email = $('.formulaire input[name="email_contact"]');
        const tel = $('.formulaire input[name="tel_contact"]');
        const message = $('.formulaire textarea[name="message_contact"]');
        let errors = 0;

        //Recaptcha
        let recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            e.preventDefault();
            alert("Please Check ReCaptcha");
            errors = 1;
        } else {
            $.post("submit.php", {
                "secret": "6Lcx5boZAAAAACmOGV_XBxSj5AI8m1GpykwGZC5-",
                "response": recaptcha
            }, function (response) {
            });
            errors = 0;
        }




        // Suppresion des erreurs au click des inputs
        nom.click(function () {
            nom.keyup(function () {
                nom.removeClass('is-invalid');
            })
            $('.inv-nom').remove();
        })

        prenom.click(function () {
            prenom.keyup(function () {
                prenom.removeClass('is-invalid');
            })
            $('.inv-prenom').remove();
        })

        email.click(function () {
            email.keyup(function () {
                email.removeClass('is-invalid');
            })
            $('.inv-email').remove();
        })

        tel.click(function () {
            tel.keyup(function () {
                tel.removeClass('is-invalid');
            })
            $('.inv-tel').remove();
        })

        message.click(function () {
            message.keyup(function () {
                message.removeClass('is-invalid');
            })
            $('.inv-message').remove();
        })

        // Vérification du nom
        if (nom.val().length == 0) {
            nom.addClass('is-invalid');
            nom.after(`
            <div class="invalid-feedback inv-nom">
                Vous devez saisir un nom !
            </div>
        `);
            errors = 1;
        }

        // Vérification du prénom
        if (prenom.val().length == 0) {
            prenom.addClass('is-invalid');
            prenom.after(`
            <div class="invalid-feedback inv-prenom">
                Vous devez saisir un prénom !
            </div>
        `);
            errors = 1;
        }

        // Vérification du email
        if (email.val().length == 0) {
            email.addClass('is-invalid');
            email.after(`
            <div class="invalid-feedback inv-email">
                Vous devez saisir un email !
            </div>
        `);
            errors = 1;
        }

        // Vérification du telephone
        if (tel.val().length == 0) {
            tel.addClass('is-invalid');
            tel.after(`
            <div class="invalid-feedback inv-tel">
                Vous devez saisir un numéro de téléphone !
            </div>
        `);
            errors = 1;
        }

        if (message.val().length < 10 || message.val().length > 500) {
            message.addClass('is-invalid');
            message.after(`
            <div class="invalid-feedback inv-message">
                Vous devez saisir un message entre 10 et 500 caractères !
            </div>
        `);
            errors = 1;
        }

        // //traitement des données et retour du serveur
        if (errors == 0) {
            $.post(
                'sendFormulaire.php',
                {
                    valeurNom: nom.val(),
                    valeurPrenom: prenom.val(),
                    valeurEmail: email.val(),
                    valeurTel: tel.val(),
                    valeurMessage: message.val()
                },
                function (data) {
                    if (data.success == 'failed') {
                        email.addClass('is-invalid');
                        email.after(`
                            <div class="invalid-feedback inv-email">
                            L'email n'est pas valide !
                            </div>
                        `);
                    } else {
                        $('.formulaire').remove();
                        $(`
                            <div class="alert alert-success">
                                Votre message a bien été envoyé !
                            </div>
                        `).appendTo($('.modal-dialog')).fadeIn(1000);

                        setTimeout(envoiSuccess, 3000);

                        nom.val('');
                        prenom.val('');
                        email.val('');
                        tel.val('');
                        message.val('');
                        setTimeout(function () { $('#modal_contact').modal('hide'); }, 3000);
                    }
                },
                'json'
            );
        }
    });

});