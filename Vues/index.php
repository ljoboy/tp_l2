<?php require '../Controllers/functions.php';
require '../Models/Etudiant.php';
isnot_connected();
$etudiant = new Etudiant($_SESSION['auth']);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="asset/css/styles.css">
    <link rel="stylesheet" href="asset/css/index.css">
    <title>Profil</title>
</head>
<body>
    <div id="container">
        <p><span class="info">Nom </span>: <?= "<span class='data'>". $etudiant->getNom() ."</span>" ?></p>
        <p><span class="info">Post-nom </span>: <?= "<span class='data'>". $etudiant->getPostnom() ."</span>" ?></p>
        <p><span class="info">Prénom </span>: <?= "<span class='data'>". $etudiant->getPrenom() ."</span>" ?></p>
        <p><span class="info">Genre </span>: <?= "<span class='data'>". $etudiant->getGenre() ."</span>" ?></p>
        <p><span class="info">Matricule </span>: <?= "<span class='data'>". $etudiant->getMatricule() ."</span>" ?></p>
        <p><span class="info">Promotion </span>: <?= "<span class='data'>". $etudiant->getPromotion() ."</span>" ?></p>
        <p><span class="info">Email </span>: <?= "<span class='data'>". $etudiant->getEmail() ."</span>" ?></p>
        <p><span class="info">Téléphone </span>: <?= "<span class='data'>". $etudiant->getTelephone() ."</span>" ?></p>
        <p><span class="info">Mot de passe </span>: <?= "<span class='data'>". $etudiant->getPassword() ."</span>" ?></p>
        <p><span class="info">Adresse </span>: <?= "<span class='data'>". $etudiant->getAdresse() ."</span>" ?></p>
    </div>
    <a class="desconnect" href="../Controllers/deconnexion.php">Se deconnecter</a>
</body>
</html>