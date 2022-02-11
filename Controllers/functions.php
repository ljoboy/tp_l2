<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db_connect() {
    try {
        $db = new PDO('mysql:dbname=esis_db;host=localhost', 'root', '');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    return $db;
}

function is_connected() {
    if (!isset($_SESSION['auth'])) {
        header('Location: /login.php');
    }
}

function isnot_connected() {
    if (!isset($_SESSION['auth'])) {
        header('Location: /');
    }
}

//Cette fonction vérifie si la valeur d'un champ du formulaire est vide

function is_empty(string $value, string $input_name) : void {
    //Si c'est le cas, on stocke la valeur($value) dans le tableau error comme clé
    if (empty($value)){
        //La valeur true pour dire qu'elle est vide
        $_SESSION['error'][$input_name] = true;
    }else{
        //Sinon si le champ contient une valeur, elle est stockée dans la session...
        //... avec comme clé le nom qui se trouve dans l'attribut 'name' du champ input
        $_SESSION[$input_name] = $value;
        //Si le champ n'avait pas été saisi précédemment, on supprime l'erreur qui avait été généré
        //Parce qu'on n'a plus besoin de garder l'erreur dans le cas ou le champ contient une valeur
        if (array_key_exists('error', $_SESSION) && array_key_exists($input_name, $_SESSION['error'])) {
            unset($_SESSION['error'][$input_name]);
        }
    }
}


function valid_data(array $data) {
    $value_attribut_names = ['nom','postnom','prenom','genre','matricule','email','phone','password','password2','adresse'];
    for ($i = 0; $i < count($data); $i++) {
        is_empty($data[$i],$value_attribut_names[$i]);
    }
}

//Cette fonction affiche la valeur entrée précédemment par l'utilisateur.
//Elle permet à l'utilisateur de ne pas entrer encore les informations qu'il avait entré précédemment...
//... dans le cas il avait été redirigé vers la page register parc eque un ou plusieurs champs étaient vides.

function print_prevous_value(string $input_name) : void {
    //la variable $input_name est la valeur de l'attribut name de la balise input...
    //Si l'utilisateur a donné une valeur à ce champ, cela veut-dire qu'elle existe dans la session(referez-vous à la fonction is_empty).
    //...et on vérifie si c'est le cas.
    if (array_key_exists($input_name, $_SESSION)) {
        //Si elle y est, on la récupère en l'affichant
        echo $_SESSION[$input_name];
        //On détruit la valeur après l'avoir affiché
        //Sinon elle sera toujours affiché à chaque fois, car elle restera stockée dans la session
        unset($_SESSION[$input_name]);
    }
    //Sinon, on affiche rien
    echo "";
}

//Cette fonction écrit l'erreur lorsqu'un champ n'a pas été rempli.

function print_error(string $input_name) : void {
    if (array_key_exists('error', $_SESSION) && array_key_exists($input_name, $_SESSION['error'])) {
        switch ($input_name) {
            case 'nom':
                echo "<span class='error'>Veuillez saisir votre nom</span><br>";
                break;
            case 'prenom':
                echo "<span class='error'>Veuillez saisir votre post-nom</span><br>";
                break;
            case 'email':
                echo "<span class='error'>Veuillez saisir votre Adresse mail</span><br>";
                break;
            case 'phone':
                echo "<span class='error'>Veuillez saisir la ville</span><br>";
                break;
            case 'matricule':
                echo "<span class='error'>Veuillez entrer votre matricule</span><br>";
                break;
            case 'genre':
                echo "<span class='error'>Veuillez spécifiez votre sexe</span><br>";
                break;
            case 'password':
                echo "<span class='error'>Veuillez saisir le mot de passe</span><br>";
                break;
            case 'password2':
                echo "<span class='error'>Veuillez saisir le mot de passe</span><br>";
                break;
            case 'adresse':
                echo "<span class='error'>Veuillez Entrez votre adresse</span><br>";
                break;
            default:
                echo "";
        }
    }
}

//student_already_registered vérifie si l'email entré est déjà enregistré avec un autre étudiant

function data_already_registered(string $name_data, string $data, string $name_table_db) {
    $bdd = db_connect();
    $search_email = $bdd->query("SELECT $name_data FROM $name_table_db");
    while ($donnees = $search_email->fetch()) {
        if ($data === $donnees[$name_data]) {
            switch ($name_data) {
                case 'email':
                    $_SESSION['email_already_registered'] = "<span class='error'>Cette adresse est déjà lié à un compte, utilisez une autre</span>";
                    break;
                case 'matricule':
                    $_SESSION['matricule_already_registered'] = "<span class='error'>Ce matricule appartient à une autre personne, utilisez un autre</span>";
                    break;
                case 'phone':
                    $_SESSION['tel_already_registered'] = "<span class='error'>Ce numéro est déjà lié à un compte, utilisez ne autre</span>";
                    break;
            }
        }
    }
}