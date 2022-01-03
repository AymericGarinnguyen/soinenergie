<?php

//si la session user n'est pas définie : redirection
if (!isset($_SESSION['user'])) {
    header('location:../index.php');
    exit();
}

// Quand on se deconnecte
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy(); //destruction
    header('location:../index.php'); //redirection
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">
        Administration
        <a href="?logout=true" class="ml-2 mr-5" title="Fermer l'administration">
            <i class="far fa-times-circle"></i>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php active('/blog_lucy/admin/index.admin.php'); ?>">
                <a class="nav-link" href="index.admin.php">Index</a>
            </li>
            <li class="nav-item <?php active('/blog_lucy/admin/articles.admin.php'); ?>">
                <a class="nav-link" href="articles.admin.php">Articles</a>
            </li>
            <li class="nav-item <?php active('/blog_lucy/admin/soins.admin.php'); ?>">
                <a class="nav-link" href="soins.admin.php">Autres Soins</a>
            </li>
            <!-- <li class="nav-item <?php active('/blog_lucy/admin/partage.admin.php'); ?>">
                <a class="nav-link" href="partage.admin.php">Partage</a>
            </li> -->
            <li class="nav-item <?php active('/blog_lucy/admin/don.admin.php'); ?>">
                <a class="nav-link" href="don.admin.php">Don</a>
            </li>
        </ul>
    </div>
</nav>