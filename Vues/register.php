<?php require '../Controllers/functions.php'?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Enregistrement</title>
</head>
<body>
<?php
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
?>
<h1>Formulaire d'enregistrement</h1>
<form action="../Controllers/register.php" method="post">
    <label for="nom">Nom</label> : <input type="text" name="nom" id="nom" value="<?php print_prevous_value('nom'); ?>"><br>
    <?php print_error('nom');?>
    <label for="postnom">Post-Nom</label> : <input type="text" name="postnom" id="postnom" value="<?php print_prevous_value('postnom'); ?>"><br>
    <?php print_error('postnom');?>
    <label for="prenom">Prénom</label> : <input type="text" name="prenom" id="prenom" value="<?php print_prevous_value('prenom'); ?>"><br>
    <?php print_error('prenom');?>
    <label for="matricule">Matricule</label>: <input type="text" name="matricule" id="matricule" value="<?php print_prevous_value('matricule'); ?>"><br>
    <?php print_error('matricule'); if (array_key_exists('matricule_already_registered', $_SESSION)) echo $_SESSION['matricule_already_registered']; else echo "";?>
    <label for="email">Email</label> : <input type="email" name="email" id="email" value="<?php print_prevous_value('email'); ?>"><br>
    <?php print_error('email'); if (array_key_exists('email_already_registered', $_SESSION)) echo $_SESSION['email_already_registered']; else echo "";?>
    <label for="phone">Téléphone</label> : <input type="tel" name="phone" id="phone" value="<?php print_prevous_value('phone'); ?>"><br>
    <?php print_error('phone'); if (array_key_exists('tel_already_registered', $_SESSION)) echo $_SESSION['tel_already_registered']; else echo "";?>
    <label for="password">Mot de passe</label> : <input type="password" name="password" id="password" value="<?php print_prevous_value('password'); ?>"><br>
    <?php print_error('password');?>
    <label for="password2">Confirmer le mot de passe</label> : <input type="password" name="password2" id="password2" value="<?php print_prevous_value('password2'); ?>"><br>
    <?php print_error('password2'); if (array_key_exists('msg_invalid_password', $_SESSION)) echo $_SESSION['msg_invalid_password']; else echo "";?>
    <label for="adresse">Adresse</label> : <input type="text" name="adresse" id="adresse" value="<?php print_prevous_value('adresse'); ?>"><br>
    <?php print_error('adresse');?>
    <label for="genre">Genre</label> : <select name="genre" id="genre">
        <option value="m">Masculin</option>
        <option value="f">Feminin</option>
    </select><br>
    <label for="promotion">Promotion</label> : <select name="promotion" id="promotion">
        <option value="Prepa">Prepa</option>
        <option value="L1">L1</option>
        <option value="L2">L2</option>
        <option value="L3">L3</option>
    </select><br>
    <input type="submit" value="S'enregistrer">
</form>
<a href="login.php">Se connecter</a>
</body>
</html>
<?php unset($_SESSION['msg_invalid_password']); unset($_SESSION['email_already_registered']); unset($_SESSION['tel_already_registered']); unset($_SESSION['matricule_already_registered'])?>
