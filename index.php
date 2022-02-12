<?php

require 'controllers/functions.php';
is_connected();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
</head>
<body>
    <h1>Profil de <?php echo $_SESSION['auth']['nom'] . ' ' . $_SESSION['auth']['postnom'] . ' ' . $_SESSION['auth']['prenom'];?></h1>
    <p>Nom : <?php echo $_SESSION['auth']['nom']; ?></p>
    <p>Postnom : <?php echo $_SESSION['auth']['postnom']; ?></p>
    <p>Prenom : <?php echo $_SESSION['auth']['prenom']; ?></p>
    <p>Genre : <?php echo ($_SESSION['auth']['genre'] == 'm') ? 'Masculin' : 'Feminin'; ?></p>
    <p>Matricule : <?php echo $_SESSION['auth']['matricule']; ?></p>
    <p>Promotion : <?php echo $_SESSION['auth']['promotion']; ?></p>
    <p>Email : <?php echo $_SESSION['auth']['email']; ?></p>
    <p>Telephone : <?php echo $_SESSION['auth']['telephone']; ?></p>
    <p>Password : <?php echo $_SESSION['auth']['password']; ?></p>
    <p>Adresse : <?php echo $_SESSION['auth']['adresse']; ?></p>
</body>
</html>