<?php
# On déclare que notre fichier va renvoyer du JSON
header('Content-type:application/json');


# Post du formulaire
if (!empty($_POST['valeurNom']) && !empty($_POST['valeurPrenom']) && !empty($_POST['valeurEmail']) && !empty($_POST['valeurMessage'])) {
        
    # Récupération des données POST
    $nom = $_POST['valeurNom'];
    $prenom = $_POST['valeurPrenom'];
    $email = $_POST['valeurEmail'];
    $tel = $_POST['valeurTel'];
    $message = $_POST['valeurMessage'];

    # Vérification du mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        # L'email n'est pas au bon format
        echo json_encode([
            'success' => "failed"
        ]);
    } else {

        // Envoi du mail
        $to = "lucysoinenergie@gmail.com";
        $sujet = 'COUPER LE FEU';
        $msg = 'Nom : ' . $nom . "\r\n\r\n";
        $msg .= 'Prenom : ' . $prenom . "\r\n\r\n";
        $msg .= 'Email : ' . $email . "\r\n\r\n";
        $msg .= 'Tel : ' . $tel . "\r\n\r\n";
        $msg .= 'Message : ' . $message . "\r\n";
        $headers = array(
            'From' => "LUCY@SOINENERGIE.fr",
            'Reply-To' => $email,
            'X-Mailer' => 'PHP/' . phpversion()
        );
        mail($to, $sujet, $msg, $headers);

        echo json_encode([
            'success' => "success"
        ]);
    }
} else {
    echo json_encode([
        'success' => 'failed'
    ]);
}