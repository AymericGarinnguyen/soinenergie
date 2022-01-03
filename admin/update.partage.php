<?php

require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//récupération informations partage sélectionné :
if (isset($_GET['id_partage'])) {
    $pdoStatement = $pdo->prepare('SELECT * FROM partage WHERE id_partage = :id_partage');

    //je type en INT car en bdd c'est le typage attendu !
    $pdoStatement->bindParam(':id_partage', $_GET['id_partage'], PDO::PARAM_INT);

    //exécution de la méthode préparée
    $pdoStatement->execute();

    //créer une variables qui stockera les informations récupérées :
    $dataPartage = $pdoStatement->fetch();
}

//Modification d'un partage
if (isset($_POST['updatePartage'])) {
    extract($_POST);
    $target_dir = "../assets/img/";
    $img_file = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $img_file;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    if ($img_file != NULL) {
        $image = $img_file;
    } else {
        $image = $imageActuelle;
    }
    $pdoStatement = $pdo->prepare('UPDATE `partage` SET
    `position` = :position,
    `duree` = :duree,
    `image` = :image,
    `description_img` = :description_img,
    `titre` = :titre,
    `sous_titre` = :sous_titre,
    `description` = :description,
    `web` = :web,
    `email` = :email,
    `video` = :video WHERE `id_partage` = :id_partage
    ');

    $pdoStatement->execute(array(
        ':id_partage' => $id_partage,
        ':position' => $position,
        ':duree' => $duree,
        ':image' => $image,
        ':description_img' => $descriptionImage,
        ':titre' => $titre,
        ':sous_titre' => $sous_titre,
        ':description' => $description,
        ':web' => $web,
        ':email' => $email,
        ':video' => $video
    ));

    header('location:partage.admin.php');
    exit();
}

?>

<title>lucy-soinenergie.fr | Admin</title>
</head>


<body>
    <?php include '../assets/inc/nav.admin.php'; ?>

    <div class="update-margin">
        <h1>Mise à jour</h1>

        <div class="update-form container">
            <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group col-md-4 mb-1">
                    <label for="position">Position du partage :</label>
                    <input type="text" class="form-control form-control-sm" id="position" value="<?= $dataPartage['position'] ?>" name="position">
                </div>

                <div class="form-group col-md-5 mb-1">
                    <label for="duree">Duree du partage (en minute):</label>
                    <input type="text" class="form-control form-control-sm" id="duree" value="<?= $dataPartage['duree'] ?>" name="duree">
                </div>

                <div class="form-group col-md-12 mb-2">
                    <label for="image">Image : </label>
                    <figure>
                        <img src="../assets/img/<?= $dataPartage['image'] ?>" alt="">
                    </figure>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <input type="hidden" name="imageActuelle" value="<?= $dataPartage['image'] ?>">
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="descriptionImage">Description de l'image :</label>
                    <textarea class="form-control" id="descriptionImage" rows="3" name="descriptionImage"><?= $dataPartage['description_img'] ?></textarea>
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="titre">Titre du partage :</label>
                    <input type="text" class="form-control form-control-sm" id="titre" value="<?= $dataPartage['titre'] ?>" name="titre">
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="sous_titre">sous-titre du partage :</label>
                    <input type="text" class="form-control form-control-sm" id="sous_titre" value="<?= $dataPartage['sous_titre'] ?>" name="sous_titre">
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="description">Description du partage :</label>
                    <textarea class="form-control summernote" id="description" rows="5" name="description"><?= $dataPartage['description'] ?></textarea>
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="web">Lien web :</label>
                    <input type="text" class="form-control form-control-sm" id="web" value="<?= $dataPartage['web'] ?>" name="web">
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control form-control-sm" id="email" value="<?= $dataPartage['email'] ?>" name="email">
                    <input type="hidden" value="<?= $dataPartage['id_partage'] ?>" name="id_partage">
                </div>

                <div class="form-group col-md-12 mb-1">
                    <label for="video">Lien youtube :</label>
                    <input type="text" class="form-control form-control-sm" id="video" value="<?= $dataPartage['video'] ?>" name="video">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <input class="btn btn-sm btn-block btn-success" type="submit" value="Modifier" name="updatePartage">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <button class="btn btn-sm btn-block btn-danger" type="button"><a href="partage.admin.php">Annuler</a></button>
                </div>
            </form>

        </div> <!-- <div class="creation-form"> -->
    </div>
    <?php include '../assets/inc/script.inc.php'; ?>