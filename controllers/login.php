<?php

/**
 * @Autor josh-Muleshi <jmuleshi2@gmail.com>
 * initialisation de la session
 */

session_start();
require 'functions.php';

$db = db_connect();

if (isset($_POST['email']) || isset($_POST['password'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        header('Location: login.php?error=email is required');
        exit();
    }else if(empty($password)){
        header('Location: login.php?error=password is required');
        exit();
    }else{
        $q = $db->prepare("SELECT * FROM esis_db.etudiant WHERE password = :password AND email = :email)");

        $q->execute([
            'password' => $password,
            'email' => $email
        ]);

        $count = $statement->rowCount();
        if($count > 0){
        $_SESSION['auth'] = $email;
        header('Location: index.php');
        }else{
            $message = '<label>Email or Password incorrect</label>';
        }
    }
}else{
    header('Location: login.php');
    exit();
}
