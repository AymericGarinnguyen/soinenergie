<?php

// Function pour activer le bouton selectionné
function active($url)
{
    if ($_SERVER["PHP_SELF"] == $url) {
        echo 'active';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="tVU2vMfdEYm8jBQdguX5aTareFN9_rKFIQpnzJ6Ykdc" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- CSS FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <?php
    if (strpos($_SERVER["PHP_SELF"], "admin")) {

    ?>
        <!-- CSS ADMIN-->
        <link href="../assets/css/kothing-editor.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css/style.admin.css">
    <?php
    } else {
    ?>
        <!-- CSS GENERAL, NAV et FOOTER-->
        <link rel="stylesheet" href="assets/css/style.general.css">
        <link rel="stylesheet" href="assets/css/style.nav.css">
        <link rel="stylesheet" href="assets/css/style.footer.css">
    <?php
    } ?>

    <title>Lucy Lefébure</title>
    <meta name="description" content="Coupeuse de Feu - Energéticienne - Soins à distance pour soulager douleurs et maux. Accompagnement : radiothérapie, chimiothérapie, post-chirurgie..." />