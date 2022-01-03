<?php
require '../assets/inc/init.inc.php';

include '../assets/inc/head.inc.php';


if (isset($_POST['modifier'])) {
    extract($_POST);
    $target_dir = "../assets/img/";
    $img_file_image = basename($_FILES["image"]["name"]);
    $target_file_image = $target_dir . $img_file_image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_image);
    if ($img_file_image != NULL) {
        $image = $img_file_image;
    } else {
        $image = $_SESSION['don']['image'];
    }

    $pdoStatement = $pdo->prepare('UPDATE `don` SET
    `image` =:image,
    `description` =:description,
    `texte` =:texte
    ');
    $pdoStatement->execute(array(
        ':image' => $image,
        ':description' => $description,
        ':texte' => $texte
    ));

    header('location:don.admin.php');
    exit();
}

?>

<!-- STYLE CSS -->
<link rel="stylesheet" href="../assets/css/style.admin.css">

<title>lucy-soinenergie.fr | Admin</title>
</head>

<body>
    <?php include '../assets/inc/nav.admin.php'; ?>


    <div class="container-fluid">
        <form class="mt-5 accueil" method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div class="form-group col-md-12 mb-4">
                <label for="image">Image : </label>
                <img src="../assets/img/<?= $_SESSION['don']['image'] ?>" alt="">
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="form-group col-md-12 mb-4">
                <label for="description">Description de l'image : </label>
                <input type="text" class="form-control form-control-sm" id="description" value="<?= $_SESSION['don']['description'] ?>" name="description">
            </div>
            
            <div class="form-group col-md-12 mb-4">
                <label for="my-editor">Texte du cadre don:</label>
                <textarea class="form-control" id="my-editor" rows="5" name="texte"><?= $_SESSION['don']['texte'] ?></textarea>
            </div>
            <div class="form-group col-md-2 mb-4">
                <input class="btn btn-sm btn-block btn-success valider" type="submit" value="Modifier" name="modifier">
            </div>
            

        </form>
    </div>


    <?php include '../assets/inc/script.inc.php'; ?>