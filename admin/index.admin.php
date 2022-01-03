<?php
require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

if (isset($_POST['modifier'])) {
    extract($_POST);
    $target_dir = "../assets/img/";
    $img_file_contact = basename($_FILES["contact"]["name"]);
    $img_file_don = basename($_FILES["don"]["name"]);
    $target_file_contact = $target_dir . $img_file_contact;
    $target_file_don = $target_dir . $img_file_don;
    move_uploaded_file($_FILES["contact"]["tmp_name"], $target_file_contact);
    move_uploaded_file($_FILES["don"]["tmp_name"], $target_file_don);

    if ($img_file_contact != NULL) {
        $contact = $img_file_contact;
    } else {
        $contact = $_SESSION['accueil']['contact'];
    }

    if ($img_file_don != NULL) {
        $don = $img_file_don;
    } else {
        $don = $_SESSION['accueil']['don'];
    }

    $pdoStatement = $pdo->prepare('UPDATE `accueil` SET
    `titre` =:titre,
    `presentation` =:presentation,
    `contact` =:contact,
    `contactBtn` =:contactBtn,
    `don` =:don,
    `donBtn` =:donBtn
    ');
    $pdoStatement->execute(array(
        ':titre' => $titre,
        ':presentation' => $presentation,
        ':contact' => $contact,
        ':contactBtn' => $contactBtn,
        ':don' => $don,
        ':donBtn' => $donBtn
    ));

    header('location:index.admin.php');
    exit();
}

?>

<!-- STYLE CSS -->
<link rel="stylesheet" href="../assets/css/style.admin.css">
</head>

<body>
    <?php include '../assets/inc/nav.admin.php'; ?>


    <div class="container-fluid">
        <form class="mt-5 accueil" method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div class="form-group col-md-12 mb-4">
                <label for="titre">Titre (le H1 de la page d'accueil): </label>
                <input type="text" class="form-control form-control-sm" id="titre" value="<?= $_SESSION['accueil']['titre'] ?>" name="titre">
            </div>
            
            <div class="form-group col-md-12 mb-4">
                <label for="my-editor">Presentation (mieux si le titre est en H2):</label>
                <textarea class="form-control" id="my-editor" rows="5" name="presentation"><?= $_SESSION['accueil']['presentation'] ?></textarea>
            </div>

            <div class="form-group col-md-12 mb-4">
                <label for="contact">Image du contact : </label>
                <img src="../assets/img/<?= $_SESSION['accueil']['contact'] ?>" alt="">
                <input type="file" class="form-control-file" id="contact" name="contact">
            </div>
            <div class="form-group col-md-12 mb-4">
                <label for="contactBtn">Bouton contact :</label>
                <input type="text" class="form-control form-control-sm" id="contactBtn" value="<?= $_SESSION['accueil']['contactBtn'] ?>" name="contactBtn">
            </div>
            <div class="form-group col-md-12 mb-4">
                <label for="don">Image du don : </label>
                <img src="../assets/img/<?= $_SESSION['accueil']['don'] ?>" alt="">
                <input type="file" class="form-control-file" id="don" name="don">
            </div>
            <div class="form-group col-md-12 mb-4">
                <label for="donBtn">Bouton don :</label>
                <input type="text" class="form-control form-control-sm" id="donBtn" value="<?= $_SESSION['accueil']['donBtn'] ?>" name="donBtn">
            </div>
            <div class="form-group col-md-2 mb-4">
                <input class="btn btn-sm btn-block btn-success valider" type="submit" value="Modifier" name="modifier">
            </div>
            

        </form>
    </div>


    <?php include '../assets/inc/script.inc.php'; ?>