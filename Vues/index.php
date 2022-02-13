<?php require '../Controllers/functions.php';
require '../Models/Etudiant.php';
isnot_connected();
$etudiant = new Etudiant($_SESSION['auth']);
?>
Nom : <?php echo $etudiant->getNom() ?><br/>
Postnom : <?php echo $etudiant->getPostnom() ?><br/>
Prenom : <?php echo $etudiant->getPrenom() ?><br/>
Genre : <?php echo $etudiant->getGenre() ?><br/>
Matricule : <?php echo $etudiant->getMatricule() ?><br/>
Promotion : <?php echo $etudiant->getPromotion() ?><br/>
Email : <?php echo $etudiant->getEmail() ?><br/>
Telephone : <?php echo $etudiant->getTelephone() ?><br/>
Password : <?php echo $etudiant->getPassword() ?><br/>
Adresse : <?php echo $etudiant->getAdresse() ?><br/>

<a href="../Controllers/deconnexion.php">Se deconnecter</a>
