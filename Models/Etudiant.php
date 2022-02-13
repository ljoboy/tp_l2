<?php
require_once '../Controllers/functions.php';

//Création de la class Étudiant
class Etudiant
{
    //Déclaration des propriétés
    private string $nom;
    private string $postnom;
    private string $prenom;
    private string $genre;
    private string $matricule;
    private string $promotion;
    private string $email;
    private string $telephone;
    private string $adresse;
    private string $password;

    public function __construct(string $email) {
        //Connexion à la base de données
        $db = db_connect();

        //Selection des données de l'étudiant dans la base de données
        $search = $db->prepare("SELECT * FROM esis_db.etudiant WHERE email = :matricule");
        $search->execute(['matricule' => $email]);

        //Recuperation des données dans la base de données
        $data = $search->fetch();
        $this->nom = $data['nom'];
        $this->postnom = $data['postnom'];
        $this->prenom = $data['prenom'];
        $this->genre = $data['genre'];
        $this->matricule = $data['matricule'];
        $this->promotion = $data['promotion'];
        $this->email = $data['email'];
        $this->telephone = $data['telephone'];
        $this->adresse = $data['adresse'];
        $this->password = $data['password'];
    }

    //Fonction getters

    public function getNom() : string
    {
        return $this->nom;
    }

    public function getPostnom() : string
    {
        return $this->postnom;
    }

    public function getPrenom() : string
    {
        return $this->prenom;
    }

    public function getGenre() : string
    {
        return $this->genre;
    }

    public function getMatricule() : string
    {
        return $this->matricule;
    }

    public function getPromotion() : string
    {
        return $this->promotion;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getTelephone() : string
    {
        return $this->telephone;
    }

    public function getAdresse() : string
    {
        return $this->adresse;
    }

    public function getPassword() : string
    {
        return $this->password;
    }
}
