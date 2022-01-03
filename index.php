<?php

if ($_SERVER['REQUEST_URI'] == '/index.php') header('Location:/');
require 'assets/inc/init.inc.php';

include 'assets/inc/head.inc.php';
?>

<!-- STYLE CSS -->
<link rel="stylesheet" href="assets/css/style.index.css">
</head>

<body class="h-100">
    <div class="container principale h-100">
        <div class="d-flex flex-column h-100">

            <?php include 'assets/inc/nav.inc.php'; ?>


            <main class="flex-shrink-0">

                <section class="accueil">
                    <div class="row main-accueil">


                        <div class="cadre-accueil">
                            <h1>
                            <?= $_SESSION['accueil']['titre'] ?>
                            </h1>
                            <div class="presentation">
                                <?= $_SESSION['accueil']['presentation'] ?>
                            </div>

                        </div>

                    </div>



                    <?php while ($article = $pdoArticle->fetch(PDO::FETCH_ASSOC)) : ?>

                        <div class="articles <?= ($article['display'] == 1) ? '' : 'displayHide' ?>">
                            <figure class="imagePosition">
                                <img src="assets/img/<?= $article['image'] ?>" alt="<?= $article['description_image'] ?>">
                            </figure>
                            <div class="acc-corps">
                                <?= $article['description'] ?>
                            </div>

                        </div>


                    <?php endwhile; ?>


                    <?php include 'assets/inc/footer.inc.php'; ?>