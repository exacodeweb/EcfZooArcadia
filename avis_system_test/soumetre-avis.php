<?php
// Inclure la configuration de la base de données
//include 'includes/db-connection.php';
require_once '../config/config_unv.php';

// Vérifier que les données ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données soumises
  $nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

  // Vérifier que les champs ne sont pas vides
  if (!empty($nom) && !empty($message)) {
    try {
      // Préparer l'insertion dans la base de données  //Avis
      $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
      $stmt->execute([
        ':auteur' => $nom,
        ':message' => $message
      ]);

      //if ($stmt->execute()) {}
      // Redirection vers la page de remerciement
      header("Location: ./thank_you_avis.php");
      exit;
    } catch (PDOException $e) {
      echo "Erreur : " . $e->getMessage();
    }
  } else {
    echo "Veuillez remplir tous les champs.";
  }
} else {
  echo "Méthode non autorisée.";
}
