<?php
require 'assets/inc/init.inc.php';

include 'assets/inc/head.inc.php';
?>
<meta name="robots" content="noindex">
<!-- STYLE CSS -->
<link rel="stylesheet" href="assets/css/style.don.css">
</head>

<body class="h-100">
    <div class="container principale h-100">
        <div class="d-flex flex-column h-100">

            <?php include 'assets/inc/nav.inc.php'; ?>


            <main class="flex-shrink-0">

                <section class="donation">

                    <div class="don">
                        <figure class="imagePosition">
                            <img src="assets/img/<?= $_SESSION['don']['image'] ?>" alt="<?= $_SESSION['don']['description'] ?>">
                        </figure>
                        <div class="text-don">
                            <?= $_SESSION['don']['texte'] ?>
                        </div>
                    </div>


                    <?php include 'assets/inc/footer.inc.php'; ?>