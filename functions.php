<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db_connect() {
    try {
        $db = new PDO('mysql:dbname=esis;host=localhost', 'root', 'toor');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    return $db;
}

function is_connected() {
    if (isset($_SESSION['auth'])) {
        header('Location: /');
    }
}

function isnot_connected() {
    if (!isset($_SESSION['auth'])) {
        header('Location: /login.php');
    }
}
