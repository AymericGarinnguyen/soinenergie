<?php

require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//récupération informations soin sélectionné :
if (isset($_GET['id_soins'])) {
    $pdoStatement = $pdo->prepare('SELECT * FROM soins WHERE id_soins = :id_soins');

    //je type en INT car en bdd c'est le typage attendu !
    $pdoStatement->bindParam(':id_soins', $_GET['id_soins'], PDO::PARAM_INT);

    //exécution de la méthode préparée
    $pdoStatement->execute();

    //créer une variables qui stockera les informations récupérées :
    $dataSoins = $pdoStatement->fetch();
}

//Modification d'un soin
if (isset($_POST['updateSoins'])) {
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
    $pdoStatement = $pdo->prepare('UPDATE `soins` SET
    `position_soins` = :position_soins,
    `image_soins` = :image_soins,
    `description_image_soins` = :description_image_soins,
    `nom_soins` = :nom_soins,
    `description_soins` = :description_soins WHERE `id_soins` = :id_soins
    ');

    $pdoStatement->execute(array(
        ':id_soins' => $id_soins,
        ':position_soins' => $position,
        ':image_soins' => $image,
        ':description_image_soins' => $descriptionImage,
        ':nom_soins' => $nom,
        ':description_soins' => $descriptionSoins
        ));
        
    header('location:soins.admin.php');
    exit();
}
?>

<title>lucy-soinenergie.fr | Admin</title>
</head>


<body>
    <?php include '../assets/inc/nav.admin.php'; ?>

    <div class="update-margin">
        <h1>Mise à jour du soin : <?= $dataSoins['nom_soins'] ?></h1>

        <div class="update-form container">
            <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group col-md-4 mb-4">
                    <label for="position">Position :</label>
                    <input type="text" class="form-control form-control-sm" id="position" name="position" value="<?= $dataSoins['position_soins'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="image">Image : </label>
                    <figure>
                        <img src="../assets/img/<?= $dataSoins['image_soins'] ?>" alt="">
                    </figure>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <input type="hidden" name="imageActuelle" value="<?= $dataSoins['image_soins'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="description-image">Description de l'image :</label>
                    <textarea class="form-control" id="description-image" rows="3" name="descriptionImage"><?= $dataSoins['description_image_soins'] ?></textarea>
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="nom">Nom du soin:</label>
                    <input type="text" class="form-control form-control-sm" id="nom" name="nom"  value="<?= $dataSoins['nom_soins'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="my-editor">Description du soin :</label>
                    <textarea class="form-control" id="my-editor" rows="3" name="descriptionSoins"><?= $dataSoins['description_soins'] ?></textarea>
                    <input type="hidden" value="<?= $dataSoins['id_soins'] ?>" name="id_soins">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <input class="btn btn-sm btn-block btn-success valider" type="submit" value="Modifier" name="updateSoins">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <button class="btn btn-sm btn-block btn-danger" type="button"><a href="soins.admin.php">Annuler</a></button>
                </div>
            </form>


        </div> <!-- <div class="creation-form"> -->
    </div>
    <?php include '../assets/inc/script.inc.php'; ?>