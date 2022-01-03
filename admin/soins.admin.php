<?php
require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';

//je vérifie si delete et id_soins sont définis et que $_GET['delete'] a pour valeur true
if ((isset($_GET['delete']) && $_GET['delete'] == 'true') && (isset($_GET['id_soins']))) {
    $deleteSoins = $pdo->prepare("DELETE FROM soins WHERE id_soins = :idSoins");
    $deleteSoins->bindParam(':idSoins', $_GET['id_soins'], PDO::PARAM_INT);
    $deleteSoins->execute();

    header('location:soins.admin.php?delete=success');
    exit();
}

//si on clique sur le bouton "see"
if ((isset($_GET['see']) && $_GET['see'] == 1) || (isset($_GET['see']) && $_GET['see'] == 0) && (isset($_GET['id_soins']))) {
    $display = (($_GET['see'] == 1) ? 0 : 1);
    $seeSoins = $pdo->prepare("UPDATE `soins` SET `display_soins` = :display_soins WHERE `id_soins` = :idSoins");
    $seeSoins->bindParam(':idSoins', $_GET['id_soins'], PDO::PARAM_INT);
    $seeSoins->bindParam(':display_soins', $display, PDO::PARAM_INT);
    $seeSoins->execute();
    header('location:soins.admin.php');
    exit();
}

//création d'un nouveau soin
if (isset($_POST['newSoins'])) {
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

    $pdoStatement = $pdo->prepare('INSERT INTO `soins`(
    `id_soins`,
    `position_soins`,
    `image_soins`,
    `description_image_soins`,
    `nom_soins`,
    `description_soins`) VALUES (?,?,?,?,?,?)');

    $pdoStatement->execute(array(
        null,
        $position,
        $image,
        $descriptionImage,
        $nom,
        $descriptionSoins
    ));

    header('location:soins.admin.php');
    exit();
}

?>

<title>lucy-soinenergie.fr | Admin</title>
</head>

<body>
    <?php include '../assets/inc/nav.admin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="liste-accompagnement">
                <h2>Soins</h2>
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
                            <?php while ($soins = $pdoSoins->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td>
                                        <figure>
                                            <img src="../assets/img/<?= $soins['image_soins'] ?>" alt="">
                                        </figure>
                                    </td>
                                    <td><?= $soins['nom_soins'] ?></td>
                                    <td><?= $soins['position_soins'] ?></td>
                                    <td class="see"><a href="?id_soins=<?= $soins['id_soins']; ?>&see=<?= ($soins['display_soins'] == 1) ? 1 : 0 ?>"><?= ($soins['display_soins'] == 1) ? '<i class="fas fa-eye">' : '<i class="fas fa-eye-slash">' ?></i></a></td>
                                    <td class="modif"><a href="update.soins.php?id_soins=<?= $soins['id_soins']; ?>"><i class="fas fa-user-edit"></i></a></td>
                                    <td class="suppr"><a href="?id_soins=<?= $soins['id_soins']; ?>&delete=true"><i class="fas fa-user-slash"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="creation-accompagnement">
                <h2>Création d'un soin</h2>
                <div class="accompagnement-form">
                    <form class="form row" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-4 mb-4">
                            <label for="position">Position :</label>
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
                            <label for="nom">Nom du soin :</label>
                            <input type="text" class="form-control form-control-sm" id="nom" name="nom">
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="my-editor">Description du soin :</label>
                            <textarea class="form-control" id="my-editor" rows="3" name="descriptionSoins"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <input class="btn btn-md btn-block btn-success valider" type="submit" value="Nouveau Soin" name="newSoins">
                        </div>
                    </form>

                </div> <!-- <div class="accompagnement-form"> -->
            </div> <!-- <div class="accompagnement-podcast"> -->
        </div> <!-- <div class="row"> -->
    </div> <!-- <div class="container-fluid"> -->




    <?php include '../assets/inc/script.inc.php'; ?>