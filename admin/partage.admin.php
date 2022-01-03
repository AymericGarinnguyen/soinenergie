<?php
require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//je vérifie si delete et id_partage sont définis et que $_GET['delete'] a pour valeur true
if ((isset($_GET['delete']) && $_GET['delete'] == 'true') && (isset($_GET['id_partage']))) {
    $deletePodcast = $pdo->prepare("DELETE FROM partage WHERE id_partage = :idPartage");
    $deletePodcast->bindParam(':idPartage', $_GET['id_partage'], PDO::PARAM_INT);
    $deletePodcast->execute();

    header('location:partage.admin.php?delete=success');
    exit();
}

//si on clique sur le bouton "see"
if ((isset($_GET['see']) && $_GET['see'] == 1) || (isset($_GET['see']) && $_GET['see'] == 0) && (isset($_GET['id_partage']))) {
    $display = (($_GET['see'] == 1) ? 0 : 1);
    $seePodcast = $pdo->prepare("UPDATE `partage` SET `display` = :display WHERE `id_partage` = :idPartage");
    $seePodcast->bindParam(':idPartage', $_GET['id_partage'], PDO::PARAM_INT);
    $seePodcast->bindParam(':display', $display, PDO::PARAM_INT);
    $seePodcast->execute();
    header('location:partage.admin.php');
    exit();
}

//création d'un nouveau poartage
if (isset($_POST['newPartage'])) {
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

    $pdoStatement = $pdo->prepare('INSERT INTO `partage`(
    `id_partage`,
    `position`,
    `duree`,
    `image`,
    `description_img`,
    `titre`,
    `sous_titre`,
    `description`,
    `web`,
    `email`,
    `video`) VALUES (?,?,?,?,?,?,?,?,?,?,?)');

    $pdoStatement->execute(array(
        null,
        $position,
        $duree,
        $image,
        $descriptionImage,
        $titre,
        $sous_titre,
        $description,
        $web,
        $email,
        $video
    ));
    header('location:partage.admin.php');
    exit();
}

?>

<title>lucy-soinenergie.fr | Admin</title>
</head>

<body>
    <?php include '../assets/inc/nav.admin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="liste-partage">
                <h2>Mes partages</h2>
                <div class="partage-article">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Position</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($partage = $pdoPartage->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td>
                                        <figure>
                                            <img src="../assets/img/<?= $partage['image'] ?>" alt="">
                                        </figure>
                                    </td>
                                    <td><?= $partage['titre'] ?></td>
                                    <td><?= $partage['position'] ?></td>
                                    <td class="see"><a href="?id_partage=<?= $partage['id_partage']; ?>&see=<?= ($partage['display'] == 1) ? 1 : 0 ?>"><?= ($partage['display'] == 1) ? '<i class="fas fa-eye">' : '<i class="fas fa-eye-slash">' ?></i></a></td>
                                    <td class="modif"><a href="update.partage.php?id_partage=<?= $partage['id_partage']; ?>"><i class="fas fa-user-edit"></i></a></td>
                                    <td class="suppr"><a href="?id_partage=<?= $partage['id_partage']; ?>&delete=true"><i class="fas fa-user-slash"></i></a></td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="creation-partage">
                <h2>Création d'un partage</h2>
                <div class="creation-form">
                    <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-4 mb-1">
                            <label for="position">Position du partage :</label>
                            <input type="text" class="form-control form-control-sm" id="position" name="position">
                        </div>

                        <div class="form-group col-md-5 mb-1">
                            <label for="duree">Duree du partage (en minute):</label>
                            <input type="text" class="form-control form-control-sm" id="duree" name="duree">
                        </div>

                        <div class="form-group col-md-12 mb-2">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="description-image">Description de l'image :</label>
                            <textarea class="form-control" id="description-image" rows="3" name="descriptionImage"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="titre">Titre du partage :</label>
                            <input type="text" class="form-control form-control-sm" id="titre" name="titre">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="sous_titre">Sous-titre du partage :</label>
                            <input type="text" class="form-control form-control-sm" id="sous_titre" name="sous_titre">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="description">Description du partage :</label>
                            <textarea class="form-control summernote" id="description" rows="3" name="description"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="web">Lien web :</label>
                            <input type="text" class="form-control form-control-sm" id="web" name="web">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="email">Email :</label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <label for="video">Lien youtube :</label>
                            <input type="text" class="form-control form-control-sm" id="video" name="video">
                        </div>

                        <div class="form-group col-md-12 mb-1">
                            <input class="btn btn-md btn-block btn-success" type="submit" value="Nouveau Partage" name="newPartage">
                        </div>
                    </form>

                </div> <!-- <div class="creation-form"> -->
            </div> <!-- <div class="creation-podcast"> -->
        </div> <!-- <div class="row"> -->
    </div> <!-- <div class="container-fluid"> -->




    <?php include '../assets/inc/script.inc.php'; ?>