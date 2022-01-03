<?php
require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//je vérifie si delete et id_article sont définis et que $_GET['delete'] a pour valeur true
if ((isset($_GET['delete']) && $_GET['delete'] == 'true') && (isset($_GET['id_article']))) {
    $deletePodcast = $pdo->prepare("DELETE FROM articles WHERE id_article = :idArticle");
    $deletePodcast->bindParam(':idArticle', $_GET['id_article'], PDO::PARAM_INT);
    $deletePodcast->execute();

    header('location:articles.admin.php?delete=success');
    exit();
}

//si on clique sur le bouton "see"
if ((isset($_GET['see']) && $_GET['see'] == 1) || (isset($_GET['see']) && $_GET['see'] == 0) && (isset($_GET['id_article']))) {
    $display = (($_GET['see'] == 1) ? 0 : 1);
    $seePodcast = $pdo->prepare("UPDATE `articles` SET `display` = :display WHERE `id_article` = :idArticle");
    $seePodcast->bindParam(':idArticle', $_GET['id_article'], PDO::PARAM_INT);
    $seePodcast->bindParam(':display', $display, PDO::PARAM_INT);
    $seePodcast->execute();
    header('location:articles.admin.php');
    exit();
}

//création d'un nouvel article
if (isset($_POST['newArticle'])) {
    extract($_POST);
    $target_dir = "../assets/img/";
    $img_file = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $img_file;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    if ($img_file != NULL) {
        $image = $img_file;
    } else {
        $image = "";
    }

    $pdoStatement = $pdo->prepare('INSERT INTO `articles`(
    `id_article`,
    `position_accueil`,
    `image`,
    `description_image`,
    `nom`,
    `description`) VALUES (?,?,?,?,?,?)');

    $pdoStatement->execute(array(
        null,
        $position,
        $image,
        $descriptionImage,
        $nom,
        $descriptionArticle
    ));

    header('location:articles.admin.php');
    exit();
}

?>
</head>

<body>
    <?php include '../assets/inc/nav.admin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="liste-accompagnement">
                <h2>Articles</h2>
                <div class="accompagnement-article">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Position</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($accompagnement = $pdoArticle->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td>
                                        <figure>
                                            <img src="../assets/img/<?= $accompagnement['image'] ?>" alt="">
                                        </figure>
                                    </td>
                                    <td><?= $accompagnement['nom'] ?></td>
                                    <td><?= $accompagnement['position_accueil'] ?></td>
                                    <td class="see"><a href="?id_article=<?= $accompagnement['id_article']; ?>&see=<?= ($accompagnement['display'] == 1) ? 1 : 0 ?>"><?= ($accompagnement['display'] == 1) ? '<i class="fas fa-eye">' : '<i class="fas fa-eye-slash">' ?></i></a></td>
                                    <td class="modif"><a href="update.articles.php?id_article=<?= $accompagnement['id_article']; ?>"><i class="fas fa-user-edit"></i></a></td>
                                    <td class="suppr"><a href="?id_article=<?= $accompagnement['id_article']; ?>&delete=true"><i class="fas fa-user-slash"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="creation-accompagnement">
                <h2>Création d'un article "Accompagnement"</h2>
                <div class="accompagnement-form">
                    <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-4 mb-4">
                            <label for="position">Position de l'accueil :</label>
                            <input type="text" class="form-control form-control-sm" id="position" name="position">
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="description-image">Description de l'image :</label>
                            <textarea class="form-control" id="description-image" rows="3" name="descriptionImage"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="nom">Nom de l'article :</label>
                            <input type="text" class="form-control form-control-sm" id="nom" name="nom">
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="my-editor">Description de l'article :</label>
                            <textarea class="form-control" id="my-editor" rows="3" name="descriptionArticle"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <input class="btn btn-md btn-block btn-success valider" type="submit" value="Nouvel Article" name="newArticle">
                        </div>
                    </form>

                </div> <!-- <div class="accompagnement-form"> -->
            </div> <!-- <div class="accompagnement-podcast"> -->
        </div> <!-- <div class="row"> -->
    </div> <!-- <div class="container-fluid"> -->




    <?php include '../assets/inc/script.inc.php'; ?>