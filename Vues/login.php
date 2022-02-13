<?php require '../Controllers/functions.php'; is_connected(); ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="asset/css/styles.css">
    <title>Connexion</title>
</head>
<body>
<h1>Formulaire de connexion</h1>

<form action="../Controllers/login.php" method="post">
    <label for="email">Email</label> : <input type="email" id="email" name="email" value="<?php print_prevous_value('email'); ?>"><br/>
    <?php check_email(); print_error_msg('email','login');?>
    <label for="password">Mot de passe</label> : <input type="password" id="password" name="password" value="<?php print_prevous_value('password'); ?>"><br>
    <?php check_password(); print_error_msg('password', 'login'); ?>
    <input type="submit" value="Se connecter">
</form>
<a href="register.php">S'enregistrer</a>
</body>
</html>
<?php
    //On supprime les erreurs qui avaient été créées dans le cas ou les données saisies étaient incorrect
    delete_error('login');
?>
