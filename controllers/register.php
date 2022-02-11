<?php
require 'functions.php';

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

$db = db_connect();

$q = $db->prepare("INSERT INTO esis_db.etudiant(nom, postnom, prenom, genre, matricule, promotion, adresse, telephone, password, email) VALUES (:nom, :postnom, :prenom, :genre, :matricule, :promotion, :adresse, :telephone, :password, :email)");

$q->execute([
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
