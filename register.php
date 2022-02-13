<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enregistrement</title>
</head>
<body>
<h1>Formulaire d'enregistrement</h1>
<form action="controllers/register.php" method="post">
    Nom : <input required type="text" name="nom"><br><br>
    Postnom : <input required type="text" name="postnom"><br><br>
    Prenom : <input required type="text" name="prenom"><br><br>
    Matricule : <input required type="text" name="matricule"><br><br>
    Email : <input required type="email" name="email"><br><br>
    Phone : <input required type="tel" name="phone"><br><br>
    Mot de passe : <input required type="password" name="password"><br><br>
    Confirmer : <input required type="password" name="password2"><br><br>
    Adresse :  <input required type="text" name="adresse"><br><br>
    Genre :
    <select name="genre">
        <option value="m">Masculin</option>
        <option value="f">Feminin</option>
    </select><br><br>
    Promotion :
    <select name="promotion">
        <option value="Prepa">Prepa</option>
        <option value="L1">L1</option>
        <option value="L2">L2</option>
        <option value="L3">L3</option>
    </select><br><br>
    <input type="submit" value="S'enregistrer">
</form><br>
<a href="login.php">Se connecter</a>
</body>
</html>
