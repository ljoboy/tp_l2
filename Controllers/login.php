<?php

require 'functions.php';

//Recuperation des données
$email = $_POST['email'];
$password = $_POST['password'];

//Vérification des données entrées par l'utilisateur
is_empty($email, 'email');
is_empty($password, 'password');

//Création des messages d'erreurs pour les champs vides
empty_data_error_msg();

//Si l'un des champs est vide, on redirige l'utilisateur
if (array_key_exists('error', $_SESSION) && !empty($_SESSION['error'])) {
    header("Location: ../Vues/login.php");
    die();
}
unset($_SESSION['error']);

//Connexion à la base de données
$db = db_connect();

//Recupération de toutes les adresses des utilisateurs
$user = $db->query('SELECT esis_db.etudiant.email FROM etudiant');

//On vérifie si l'email est présent dans la base de données
$user_exist = false;
while ($data = $user->fetch()) {
    if ($email === $data['email']) {
        $user_exist = true;
        break;
    }
}

//Si l'étudiant est déjà enregistré
if ($user_exist === false) {
    $_SESSION['user_not_found'] = "<p class='error'>Ce compte n'existe pas</p><br>";
    header('Location: ../Vues/login.php');
    die();
}

//Recupération du mot de passe
$req = $db->prepare("SELECT esis_db.etudiant.password FROM etudiant WHERE email = :email");
$req->execute(['email' => $email]);
$correct_password = $req->fetch()['password'];

//Vérification du mot de passe
if ($correct_password !== $password) {
    $_SESSION['invalid_password'] = "<p class='error'>Mot de passe incorrect</p><br>";
    header('Location: ../Vues/login.php');
    die();
}

session_unset();
//Authentification de l'étudiant
$_SESSION['auth'] = $email;
header('Location: ../Vues/index.php');
