<?php

require 'assets/inc/init.inc.php';

include 'assets/inc/head.inc.php';
?>

<!-- STYLE CSS -->
<link rel="stylesheet" href="assets/css/style.autresSoins.css">
</head>

<body class="h-100">
    <div class="container principale h-100">
        <div class="d-flex flex-column h-100">

            <?php include 'assets/inc/nav.inc.php'; ?>


            <main class="flex-shrink-0">

                <section class="accueil-soins">

                    <?php while ($soins = $pdoSoins->fetch(PDO::FETCH_ASSOC)) : ?>

                        <div class="soins">
                            <figure class="imagePosition">
                                <img src="assets/img/<?= $soins['image_soins'] ?>" alt="<?= $soins['description_image_soins'] ?>">
                            </figure>
                            <div class="acc-corps-soins">
                                <?= $soins['description_soins'] ?>
                            </div>

                        </div>


                    <?php endwhile; ?>


                    <?php include 'assets/inc/footer.inc.php'; ?>