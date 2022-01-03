<?php

require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//récupération informations membre sélectionné :
if (isset($_GET['id_article'])) {
    $pdoStatement = $pdo->prepare('SELECT * FROM articles WHERE id_article = :id_article');

    //je type en INT car en bdd c'est le typage attendu !
    $pdoStatement->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);

    //exécution de la méthode préparée
    $pdoStatement->execute();

    //créer une variables qui stockera les informations récupérées :
    $dataArticle = $pdoStatement->fetch();
}

//Modification d'un article
if (isset($_POST['updateArticle'])) {
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
    $pdoStatement = $pdo->prepare('UPDATE `articles` SET
    `position_accueil` = :position_accueil,
    `image` = :image_article,
    `description_image` = :descriptionImage,
    `nom` = :nom,
    `description` = :description_article WHERE `id_article` = :id_article
    ');

    $pdoStatement->execute(array(
        ':id_article' => $id_article,
        ':position_accueil' => $position,
        ':image_article' => $image,
        ':descriptionImage' => $descriptionImage,
        ':nom' => $nom,
        ':description_article' => $descriptionArticle
        ));
        
    header('location:articles.admin.php');
    exit();
}
?>

<title>lucy-soinenergie.fr | Admin</title>
</head>


<body>
    <?php include '../assets/inc/nav.admin.php'; ?>

    <div class="update-margin">
        <h1>Mise à jour de l'article : <?= $dataArticle['nom'] ?></h1>

        <div class="update-form container">
            <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group col-md-4 mb-4">
                    <label for="position">Position de l'accueil :</label>
                    <input type="text" class="form-control form-control-sm" id="position" name="position" value="<?= $dataArticle['position_accueil'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="image">Image : </label>
                    <figure>
                        <img src="../assets/img/<?= $dataArticle['image'] ?>" alt="">
                    </figure>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <input type="hidden" name="imageActuelle" value="<?= $dataArticle['image'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="description-image">Description de l'image :</label>
                    <textarea class="form-control" id="description-image" rows="3" name="descriptionImage"><?= $dataArticle['description_image'] ?></textarea>
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="nom">Nom de l'article :</label>
                    <input type="text" class="form-control form-control-sm" id="nom" name="nom"  value="<?= $dataArticle['nom'] ?>">
                </div>

                <div class="form-group col-md-12 mb-4">
                    <label for="my-editor">Description de l'article :</label>
                    <textarea class="form-control" id="my-editor" rows="3" name="descriptionArticle"><?= $dataArticle['description'] ?></textarea>
                    <input type="hidden" value="<?= $dataArticle['id_article'] ?>" name="id_article">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <input class="btn btn-sm btn-block btn-success valider" type="submit" value="Modifier" name="updateArticle">
                </div>

                <div class="form-group col-md-2 mb-4">
                    <button class="btn btn-sm btn-block btn-danger" type="button"><a href="articles.admin.php">Annuler</a></button>
                </div>
            </form>

        </div> <!-- <div class="creation-form"> -->
    </div>
    <?php include '../assets/inc/script.inc.php'; ?>