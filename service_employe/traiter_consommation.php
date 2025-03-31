<?php
//require '../config/database.php';
require_once '../config/config_unv.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['animal_id'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nourriture = $_POST['nourriture'];
    $quantite = $_POST['quantite'];
    $employe_id = $_SESSION['user_id']; // L'employé connecté

    $stmt = $pdo->prepare("INSERT INTO consommations (animal_id, employe_id, date, heure, nourriture, quantite) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$animal_id, $employe_id, $date, $heure, $nourriture, $quantite]);

    echo "Consommation ajoutée avec succès !";
} else {
    echo "Erreur : Requête invalide.";
}
?>