<?php
require 'functions.php';
$db = db_connect();

if(
    !empty($_POST['nom']) && !empty($_POST['postnom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) &&
    !empty($_POST['genre']) && !empty($_POST['matricule']) && !empty($_POST['promotion']) && !empty($_POST['phone'])
    && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])
){
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

    $q = $db->prepare(
        "INSERT INTO esis.etudiant(nom, postnom, prenom, genre, matricule, promotion, adresse, telephone, password, email)
        VALUES (:nom, :postnom, :prenom, :genre, :matricule, :promotion, :adresse, :telephone, :password, :email)"
    );

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
    header('Location: ../index.php');
    $q->closeCursor();
}else{
    header('Location: ../register.php');
    echo 'Veuillez remplir tous les champs';
}
