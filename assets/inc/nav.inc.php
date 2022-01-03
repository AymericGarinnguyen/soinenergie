<?php

//si la session user est définie : redirection
if (isset($_SESSION['user'])) {
    header('location:admin/index.admin.php');
    exit();
}

// si la connexion de l'admin existe
if (isset($_POST['connexion'])) {
    extract($_POST);

    $pdoStatement = $pdo->prepare('SELECT * FROM user WHERE nom = :nom');
    $pdoStatement->execute(array('nom' => $nom));

    // on vérifie si le nom existe
    if ($pdoStatement->rowCount() > 0) {
        $userInfo = $pdoStatement->fetch(); // on récupère les infos de l'utilisateur

        if (password_verify($password, $userInfo['password'])) {

            //stockage des informations dans la session
            foreach ($userInfo as $key => $value) {
                if ($key != 'password') {
                    //je stocke toutes les informations dans la session sauf le password et le token
                    $_SESSION['user'][$key] = $value;
                }
            }

            //redirection
            header('location:admin/index.admin.php');
            exit();
        } else { //erreur mot de passe
            $content .= "<div class='alert alert-danger'>Mot de passe incorrect !</div>";
        }
    } else { //erreur pseudo
        $content .= "<div class='alert alert-danger'>Pseudo inexistant !</div>";
    }
}


?>

<header>
    <div class="bandeau">
        <img src="assets/img/main_bander.png" alt="Bannière du menu">
        <p id="droits">Illustrations Folon</p>
    </div>
    <nav class="navbar navbar-expand-sm navbar-light">
        <ul class="navbar-nav d-flex justify-content-center">
            <li class="nav-item">
                <a class="nav-link <?php active('/index.php'); ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php active('/autresSoins.php'); ?>" href="<?= (strpos($_SERVER['HTTP_HOST'],'localhost') === 0) ? "autresSoins.php" : "autres_soins" ?>">Les Soins</a>
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link <?php active('/partage.php'); ?>" href="<?= (strpos($_SERVER['HTTP_HOST'],'localhost') === 0) ? "partage.php" : "partage" ?>">Partages</a>
                </li> -->
            <li class="nav-item">
                <a class="nav-link <?php active('/don.php'); ?>" href="<?= (strpos($_SERVER['HTTP_HOST'],'localhost') === 0) ? "don.php" : "don" ?>">Faire un Don</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-modal" data-toggle="modal" data-target="#modal_contact">Contact</a>
            </li>
        </ul>
    </nav>


    <!-- Modal contact -->
    <div class="modal fade" id="modal_contact" tabindex="-1" role="dialog" aria-labelledby="modalLabelContact" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content formulaire" method="post" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelContact">Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- Fin div.modal-header -->

                <div class="modal-body">
                    <input type="text" class="form-control mb-2" name="nom_contact" id="nom_contact" placeholder="Nom">
                    <input type="text" class="form-control mb-2" name="prenom_contact" id="prenom_contact" placeholder="Prénom">
                    <input type="email" class="form-control mb-2" name="email_contact" id="email_contact" placeholder="E-mail">
                    <input type="tel" class="form-control mb-2" name="tel_contact" id="tel_contact" placeholder="Téléphone">
                    <textarea placeholder="Votre message..." class="form-control" id="message_contact" rows="3" name="message_contact"></textarea>
                </div> <!-- Fin div.modal-body -->
                <div class="g-recaptcha robot" data-sitekey="6Lc9nN4ZAAAAAGTqQNkG_QR0ehfBgwzs4ibTU8z7"></div>
                <br />

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary btn-sm" name="envoyer" value="Envoyer" id="envoyer">
                </div> <!-- Fin div.modal-footer -->
            </form>
        </div> <!-- Fin div.modal-dialog -->
    </div> <!-- Fin div.modal.fade -->
    <!-- Fin Modal -->
</header>