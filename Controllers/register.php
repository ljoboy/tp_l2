<?php
require 'functions.php';

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

//Si l'adresse email est déjà enregistré avec un autre étudiant
data_already_registered( 'email', $email, 'etudiant');
data_already_registered('matricule', $matricule, 'etudiant');
data_already_registered('telephone', $telephone, 'etudiant');

if (
    array_key_exists('email_already_registered',$_SESSION) OR
    array_key_exists('tel_already_registered',$_SESSION) OR
    array_key_exists('matricule_already_registered',$_SESSION)
) {
    header('Location: ../Vues/register.php');
    die();
}

//Connexion à la base de données
$db = db_connect();

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

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';