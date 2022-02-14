<?php require '../Controllers/functions.php'; is_connected();?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="asset/css/styles.css">
    <link rel="stylesheet" href="asset/css/form.css">
    <title>Enregistrement</title>
</head>
<body>
<div id="extra">
    <h1>Formulaire d'enregistrement</h1>
    <img src="asset/img/logo_lg.png" alt="logo esis">
    <a class="desconnect" href="login.php">Se connecter</a>
</div>

<form id="form" action="../Controllers/register.php" method="post">
    <div class="form_data">
        <div class="form_item">
            <label for="nom">Nom</label>
            <div class="extra">
                <input type="text" name="nom" id="nom" value="<?php print_prevous_value('nom'); ?>" placeholder="Entrez votre nom"><br>
                <?php print_error_msg('nom', 'register');?>
            </div>
        </div>

        <div class="form_item">
            <label for="postnom">Post-Nom</label>
            <div class="extra">
                <input type="text" name="postnom" id="postnom" value="<?php print_prevous_value('postnom'); ?>" placeholder="votre post-nom"><br>
                <?php print_error_msg('postnom', 'register');?>
            </div>
        </div>

        <div class="form_item">
            <label for="prenom">Prénom</label>
            <div class="extra">
                <input type="text" name="prenom" id="prenom" value="<?php print_prevous_value('prenom'); ?>" placeholder="votre prénom"><br>
                <?php print_error_msg('prenom', 'register');?>
            </div>
        </div>

        <div class="form_item">
            <label for="matricule">Matricule</label>
            <div class="extra">
                <input type="text" name="matricule" id="matricule" value="<?php print_prevous_value('matricule'); ?>" placeholder="votre matricule"><br>
                <?php print_error_msg('matricule', 'register'); if (array_key_exists('matricule_already_registered', $_SESSION)) {
    echo $_SESSION['matricule_already_registered'];
} else {
    echo "";
}?>
            </div>
        </div>

        <div class="form_item">
            <label for="email">Email</label>
            <div class="extra">
                <input type="email" name="email" id="email" value="<?php print_prevous_value('email'); ?>" placeholder="votre adresse mail"><br>
                <?php print_error_msg('email', 'register'); if (array_key_exists('email_already_registered', $_SESSION)) {
    echo $_SESSION['email_already_registered'];
} else {
    echo "";
}?>
            </div>
        </div>

        <div class="form_item">
            <label for="phone">Téléphone</label>
            <div class="extra">
                <input type="tel" name="phone" id="phone" value="<?php print_prevous_value('phone'); ?>" placeholder="votre numéro de téléphone"><br>
                <?php print_error_msg('phone', 'register'); if (array_key_exists('tel_already_registered', $_SESSION)) {
    echo $_SESSION['tel_already_registered'];
} else {
    echo "";
}?>
            </div>
        </div>

        <div class="form_item">
            <label for="password">Mot de passe</label>
            <div class="extra">
                <input type="password" name="password" id="password" value="<?php print_prevous_value('password'); ?>" placeholder="votre mot de passse"><br>
                <?php print_error_msg('password', 'register');?>
            </div>
        </div>

        <div class="form_item">
            <label for="password2">Confirmer le mot de passe</label>
            <div class="extra">
                <input type="password" name="password2" id="password2" value="<?php print_prevous_value('password2'); ?>" placeholder="votre mot de passe"><br>
                <?php print_error_msg('password2', 'register'); if (array_key_exists('msg_invalid_password', $_SESSION)) {
    echo $_SESSION['msg_invalid_password'];
} else {
    echo "";
}?>
            </div>
        </div>

        <div class="form_item">
            <label for="adresse">Adresse</label>
            <div class="extra">
                <input type="text" name="adresse" id="adresse" value="<?php print_prevous_value('adresse'); ?>" placeholder="votre adresse"><br>
                <?php print_error_msg('adresse', 'register');?>
            </div>
        </div>

        <div class="group">
            <div class="form_item">
                <label for="genre">Genre</label>
                <div class="extra">
                    <select name="genre" id="genre">
                        <option value="m">Masculin</option>
                        <option value="f">Feminin</option>
                    </select>
                </div>
            </div>

            <div class="form_item">
                <label for="promotion">Promotion</label>
                <div class="extra">
                    <select name="promotion" id="promotion">
                        <option value="Prepa">Prepa</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                    </select>
                </div>
            </div>
        </div>

    </div>

    <input type="submit" value="S'enregistrer">
</form>

</body>
</html>
<?php
    //On supprime les erreurs qui avaient été créées dans le cas ou les données saisies étaient incorrect
    delete_error('register');
?>
