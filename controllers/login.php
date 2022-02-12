<?php
session_start();

require 'functions.php';

if (!empty($_POST['email']) && !empty($_POST['password'])){
    $db = db_connect();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $q = $db->prepare(
        "SELECT nom, postnom, prenom, genre, matricule, promotion, telephone, adresse, email, password 
                FROM esis.etudiant WHERE email = :email AND password = :password"
    );
    $q->execute([
        'email' => $email,
        'password' => $password
    ]);
    $data = $q->fetchAll();

    $_SESSION['auth'] =[
        'nom' => $data[0]['nom'],
        'postnom' => $data[0]['postnom'],
        'prenom' => $data[0]['prenom'],
        'genre' => $data[0]['genre'],
        'matricule' => $data[0]['matricule'],
        'promotion' => $data[0]['promotion'],
        'telephone' => $data[0]['telephone'],
        'adresse' => $data[0]['adresse'],
        'email' => $data[0]['email'],
        'password' => $data[0]['password']
    ];
    $q->closeCursor();
    header('Location: ../index.php');
}else{
    include_once('../login.php');
}