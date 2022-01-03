<?php
require 'assets/inc/init.inc.php';

include 'assets/inc/head.inc.php';
?>
<meta name="robots" content="noindex">
<!-- STYLE CSS -->
<link rel="stylesheet" href="assets/css/style.partage.css">
</head>

<body class="h-100">

    <div id="lightbox" class="hide">
        <div class="hide video"></div>
    </div>

    <div class="container principale h-100">
        <div class="d-flex flex-column h-100">
            <?php include 'assets/inc/nav.inc.php'; ?>
            <main class="flex-shrink-0">
                <section class="partage">
                    <?php while ($partage = $pdoPartage->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="categorie-partage <?= ($partage['display'] == 1) ? '' : 'displayHide' ?>">
                            <div class="element-partage">
                                <figure class="imagePosition">
                                    <img src="assets/img/<?= $partage['image'] ?>" alt="<?= $partage['description_img'] ?>">
                                </figure>
                                <h2><?= $partage['titre'] ?></h2>
                                <?= (($partage['sous_titre'] !== "") ? '<h3>'.$partage['sous_titre'].'</h3>' : "") ?>
                                <?= (($partage['duree'] !== '0') ? '<p class="duree">Durée : '.$partage['duree'].' mn</p>' : "") ?>
                                <div class="description_partage"><?= $partage['description'] ?></div>
                                <?= (($partage['web'] !== "") ? '<a href="http://'.$partage['web'].'" target="_blank" class="web">'.$partage['web'].'</a>' : "") ?> 
                                <?= (($partage['email'] !== "") ? '<a mailto="'.$partage['email'].'">'.$partage['email'].'</a>' : "") ?>
                                <?= (($partage['video'] !== "") ? '<button class="lire" value="'. $partage["video"] .'"><i class="fab fa-youtube"></i></button>' : "") ?>
                            </div>
                        </div>

                    <?php endwhile; ?>

                    <?php include 'assets/inc/footer.inc.php'; ?>