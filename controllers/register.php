<?php
session_start();
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

    $q = $db->prepare('SELECT email, password FROM esis.etudiant WHERE email = :email AND password = :password');
    $q->execute([
        'email' => $email,
        'password' => $password
    ]);

    if ($q->fetchAll()){
        include_once('../register.php');
        echo 'Veuillez choisir un autre email et mot de passe.';
        $q->closeCursor();
    }else{
        if ($password == $password2){
            if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
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
                $_SESSION['auth'] = [
                    'nom' => $_POST['nom'],
                    'postnom' => $_POST['postnom'],
                    'prenom' => $_POST['prenom'],
                    'genre' => $_POST['genre'],
                    'matricule' => $_POST['matricule'],
                    'promotion' => $_POST['promotion'],
                    'telephone' => $_POST['phone'],
                    'adresse' => $_POST['adresse'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ];
                $q->closeCursor();
            }else{
                include_once('../register.php');
                echo 'Votre adresse email n\'est pas valide.';
            }
        }else{
            include_once('../register.php');
            echo 'Vous devez tapez le meme mot de passe dans les champs prévus à cet effet';
        }
    }
}else{
    include_once('../register.php');
    echo 'Veuillez remplir tous les champs';
}
