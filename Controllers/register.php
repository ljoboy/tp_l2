<?php

require 'functions.php';
require '../Models/Etudiant.php';

//Recuperation des données entrées par l'utilisateur
$nom = $_POST['nom'];
$postnom = $_POST['postnom'];
$prenom = $_POST['prenom'];
$genre = $_POST['genre'];
$matricule = $_POST['matricule'];
$promotion = $_POST['promotion'];
$email = $_POST['email'];
$telephone = $_POST['phone'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$adresse = $_POST['adresse'];

//Vérification des données entrées par l'utilisateur
valid_data([$nom, $postnom, $prenom, $genre, $matricule,$email,$telephone,$password,$password2,$adresse]);

//Si l'un des champs est vide, on redirige l'utilisateur
if (array_key_exists('error', $_SESSION) && !empty($_SESSION['error'])) {
    header("Location: ../Vues/register.php");
    die();
}

//Si le deux mot de passe ne correspondent pas
if ($password !== $password2) {
    $_SESSION['msg_invalid_password'] = "<span class='error'>Le mot de passe ne correspond pas au premier</span><br>";
    header("Location: ../Vues/register.php");
    die();
}

//Vérificaion du numéro de téléphone
if (preg_match("/^(0|\+243)(97|99|91|90|89|84|85|82|81)[0-9]{7}$/", $telephone) === 0) {
    $_SESSION['incorrect_number'] = "<span class='error'>Le numéro de téléphone n'est pas valide</span><br>";
}

//Vérification du matricule
$matricule = strtoupper($matricule);
$pattern_email = '(02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21){1}[A-Z]{2}\d{3}';
if (preg_match("/^$pattern_email$/", $matricule) === 0) {
    $_SESSION['incorrect_matricule'] = "<span class='error'>Le matricule n'est pas valide</span><br>";
}

//Vérification de l'adresse mail
$pattern_email = strtolower($pattern_email);
if (preg_match("/^$pattern_email@esisalama\.org$/", $email) === 0) {
    $_SESSION['incorrect_email'] = "<span class='error'>L'adresse email n'est pas valide</span><br>";
}

//On vérifie si le matricule présent dans l'adresse mail correspond au matricule entré par l'étudiant
if (substr($email, 0, 7) !== strtolower($matricule)) {
    $_SESSION['no_correspondance,matricule'] = "<span class='error'>Le matricule présent dans l'adresse doit correspondre au matricule entré</span><br>";
}

//Si l'adresse email est déjà enregistré avec un autre étudiant
data_already_registered('email', $email, 'etudiant');
data_already_registered('matricule', $matricule, 'etudiant');
data_already_registered('telephone', $telephone, 'etudiant');

if (
    array_key_exists('email_already_registered', $_SESSION) or
    array_key_exists('tel_already_registered', $_SESSION) or
    array_key_exists('matricule_already_registered', $_SESSION) or
    array_key_exists('incorrect_number', $_SESSION) or
    array_key_exists('incorrect_matricule', $_SESSION) or
    array_key_exists('incorrect_email', $_SESSION) or
    array_key_exists('no_correspondance,matricule', $_SESSION)
) {
    header('Location: ../Vues/register.php');
    die();
}

//Connexion à la base de données
$db = db_connect();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
//Insertion des données dans la base de données
$req = $db->prepare("
    INSERT INTO esis_db.etudiant(nom, postnom, prenom, genre, matricule, promotion, email, telephone, adresse, password) 
    VALUES (:nom, :postnom, :prenom, :genre, :matricule, :promotion, :email, :telephone, :adresse, :password)
");

$req->execute([
              'nom' => $nom,
              'postnom' => $postnom,
              'prenom' => $prenom,
              'genre' => $genre,
              'matricule' => $matricule,
              'promotion' => $promotion,
              'adresse' => $adresse,
              'telephone' => $telephone,
              'password' => $password,
              'email' => $email
]);

session_unset();
//Authentification de l'étudiant
$_SESSION['auth'] = $email;
header('Location: ../Vues/index.php');
