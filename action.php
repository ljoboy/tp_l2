<?php
$mail = $_POST['email'];
$mdp = $_POST['mot_de_passe'];
if ($mail = "" || $mdp = "" ) {
    echo "un des champ est vide";
    # code...
}