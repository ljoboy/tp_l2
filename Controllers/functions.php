<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db_connect() {
    try {
        $db = new PDO('mysql:dbname=esis_db;host=localhost', 'root', '');
        //Activation des erreurs PDO
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Mode de fetch par défaut :FETCH_ASSOC | FETCH_OBJ | FETCH_BOTH
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    return $db;
}

function is_connected() {
    if (array_key_exists('auth', $_SESSION)) {
        header('Location: ../Vues/index.php');
        die();
    }
}

function isnot_connected() {
    if (array_key_exists('auth', $_SESSION) === false) {
        header('Location: ../Vues/login.php');
        die();
    }
}

//Cette fonction vérifie si la valeur d'un champ du formulaire est vide

function is_empty(string $value, string $input_name) : void {
    $value = str_replace(' ','', $value);
    //Si c'est le cas, on stocke la valeur($value) dans le tableau error comme clé
    if (empty($value)){
        //La valeur true pour dire qu'elle est vide
        $_SESSION['error'][$input_name] = msg_empty_data($input_name);
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

function msg_empty_data(string $input_name) : string {
    return map($input_name, [
		'nom' => 'Le nom est obligatoire',
		'postnom' => 'Le postnom est obligatoire',
		'prenom' => 'Le prenom est obligatoire',
		'genre' => 'Le genre est obligatoire',
		'matricule' => 'Le matricule est obligatoire',
		'email' => 'L\'email est obligatoire',
		'phone' => 'Le numéro de téléphone est obligatoire',
		'password' => 'Le mot de passe est obligatoire',
		'password2' => 'La confirmation du mot de passe est obligatoire',
		'adresse' => 'L\'adresse est obligatoire'
	]);
}

//student_already_registered vérifie si l'email entré est déjà enregistré avec un autre étudiant

function data_already_registered(string $name_column, string $data, string $name_table_db) {
    $bdd = db_connect();
    $search_email = $bdd->query("SELECT $name_column FROM $name_table_db");
    while ($donnees = $search_email->fetch()) {
        if ($data === $donnees[$name_column]) {
            switch ($name_column) {
                case 'email':
                    $_SESSION['email_already_registered'] = "<span class='error'>Cette adresse est déjà lié à un compte, utilisez une autre</span><br>";
                    break;
                case 'matricule':
                    $_SESSION['matricule_already_registered'] = "<span class='error'>Ce matricule appartient à une autre personne, utilisez un autre</span><br>";
                    break;
                case 'telephone':
                    $_SESSION['tel_already_registered'] = "<span class='error'>Ce numéro est déjà lié à un compte, utilisez ne autre</span><br>";
                    break;
            }
        }
    }
}

//Vérification de l'adresse mail
function check_email() : void {
    if (array_key_exists('user_not_found', $_SESSION)) echo $_SESSION['user_not_found'];
    else echo "";
}

//Vérification du mot de passe
function check_password() : void {
    if (array_key_exists('invalid_password', $_SESSION)) echo $_SESSION['invalid_password'];
    else echo "";
}

//Création des messages erreurs
function empty_data_error_msg() : void {
    if (array_key_exists('error', $_SESSION) && $_SESSION['error']['email']) {
        $_SESSION['empty_email'] = "<span class='error'>Veuillez saisir votre adresse mail</span><br>";
    }
    if (array_key_exists('error', $_SESSION) && $_SESSION['error']['password']) {
        $_SESSION['empty_password'] = "<span class='error'>Veuillez saisir votre mot de passe</span><br>";
    }
}

//print_error_msg affiche les erreurs
function print_error_msg(string $input_name = null, string $page_name = null) : void {
    if ($input_name === 'phone') {
        if (array_key_exists('incorrect_number', $_SESSION)) echo $_SESSION['incorrect_number'];
    }
    if ($input_name === 'matricule') {
            if (array_key_exists('incorrect_matricule', $_SESSION)) echo $_SESSION['incorrect_matricule'];
    }
    if ($input_name === 'email') {
        if (array_key_exists('incorrect_email', $_SESSION)) echo $_SESSION['incorrect_email'];
        if (array_key_exists('no_correspondance,matricule', $_SESSION)) echo $_SESSION['no_correspondance,matricule'];
    }
    if ($page_name === 'login')
    {
        if (array_key_exists('empty_email', $_SESSION) && $input_name === 'email') echo $_SESSION['empty_email'];
        if (array_key_exists('empty_password', $_SESSION) && $input_name === 'password') echo $_SESSION['empty_password'];
    }
    elseif ($page_name === 'register' && array_key_exists('error', $_SESSION) && array_key_exists($input_name, $_SESSION['error']))
    {
        $input_names = ['nom','postnom','prenom','email','phone','matricule','genre','password','password2','adresse'];
        for ($i = 0; $i < count($input_names); $i++) {
            if ($input_name === $input_names[$i]) {
                echo $_SESSION['error'][$input_name];
            }
        }
    }
}

//delete_error supprime les erreurs qui avaient été créées dans le cas ou les données saisies étaient incorrect(ref login.php)
function delete_error(string $page_name) : void {
    if ($page_name === 'login')
    {
        $keys = ['user_not_found', 'invalid_password', 'empty_email', 'empty_password'];
        //La boucle va parcourir le tableau qui contient des clés et va supprimer la clé si elle existe
        for ($i = 0; $i < count($keys); $i++) {
            if (array_key_exists($keys[$i], $_SESSION)) unset($_SESSION[$keys[$i]]);
        }
    }
    elseif ($page_name === 'register')
    {
        $keys = [
            'msg_invalid_password', 'email_already_registered', 'tel_already_registered', 'matricule_already_registered',
            'incorrect_number', 'incorrect_matricule', 'incorrect_email', 'error', 'no_correspondance,matricule'
        ];
        //La boucle va parcourir le tableau qui contient des clés et va supprimer la clé si elle existe
        for ($i = 0; $i < count($keys); $i++) {
            if (array_key_exists($keys[$i], $_SESSION)) unset($_SESSION[$keys[$i]]);
        }
    }
}
