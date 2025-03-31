<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

//require_once('../public/utilise.php'); // Connexion à la BDD
require_once '../config/config_unv.php'; // a testé

// Vérifier si un ID est présent dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID employé invalide !");
}

$id = intval($_GET['id']);

// Supprimer l’employé
$sql = "DELETE FROM utilisateurs WHERE id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    header("Location: liste.php");
    exit;
} else {
    echo "Erreur lors de la suppression.";
}
?>