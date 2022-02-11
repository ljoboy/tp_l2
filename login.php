<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
<h1>Formulaire de connexion</h1>
<form action="controllers/login.php" method="post">
    Email : <input type="email" name="email"><br/>
    Mot de passe : <input type="password" name="password"><br>
    <input type="submit" value="Se connecter">
</form>
<a href="register.php">S'enregistrer</a>
</body>
</html>
