<?php

$etudiants = [
    ['email' => '19kk192@esisalama.org', 'password' => '12345', 'nom' => 'Kitenge Kinkumba Michel'],
    ['email' => '19ab023@esisalama.org', 'password' => 'azerty', 'nom' => 'Abekyamwale Baruani Jean'],
    ['email' => '18ak057@esisalama.org', 'password' => 'mot de passe', 'nom' => 'Aristo Kazadi'],
    ['email' => '18km231@esisalama.org', 'password' => 'pop123', 'nom' => 'Kilongo Mutatsh'],
    ['email' => '15um358@esisalama.org', 'password' => 'jesus', 'nom' => 'Ubite Madeleine'],
];

foreach ($etudiants as $etudiant) {
    if (($etudiant['email'] == $_POST['email']) && ($etudiant['password'] === $_POST['password'])) {
        $utilisateur = $etudiant;
    } else {
        $utilisateur = '';
    }
}

if ($utilisateur != '') {
    echo "<h1>" . $utilisateur['nom'] . " - " . $utilisateur['email'] . "<h1/>";
} else {
    echo "<h1>Adresse mail ou mot de passe incorrect</h1>";
}
