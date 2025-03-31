<?php
//require 'utilise.php'; // Fichier de connexion PDO
//require './public/utilise.php';
require './config/utilise.php';
//require_once __DIR__ . '/../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['action'])) {
  $id = (int) $_POST['id'];
  $action = $_POST['action'];

  // Vérification de l'action
  if ($action === "approuve") {
    $new_statut = "approuve";
  } elseif ($action === "rejete") {
    $new_statut = "rejete";
  } else {
    die("Action invalide.");
  }

  // Mettre à jour le statut de l'avis
  $sql = "UPDATE avis SET statut = :statut WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(['statut' => $new_statut, 'id' => $id]);

  // Redirection vers la page admin
  header("Location: admin_avis.php");
  exit();
} else {
  die("Requête invalide.");
}
