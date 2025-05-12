<?php
//require '../config/database.php';
require_once '../config/config_unv.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['habitat_id'];//animal_id
    $date = $_POST['date'];
    //$heure = $_POST['heure'];
    //$nourriture = $_POST['nourriture'];
    //$quantite = $_POST['quantite'];
    $commentaire = $_POST['commentaire'];
    $employe_id = $_SESSION['user_id']; // L'employé connecté

    $stmt = $pdo->prepare("INSERT INTO avis_habitat (id, veterinaire_id, date, commentaire) 
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$id, $veterinaire_id, $date, $commentaire]);

    echo "Commentaire ajoutée avec succès !";
} else {
    echo "Erreur : Requête invalide.";
}
?>