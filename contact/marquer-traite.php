<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: ../index.php');
  exit();
}

include('../config/config_unv.php');

if (isset($_POST['contact_id'])) {
  $id = intval($_POST['contact_id']);

  $stmt = $pdo->prepare("UPDATE contacts SET statut = 'trait' WHERE id = ?");//traité
  $stmt->execute([$id]);

  header('Location: view_contacts.php'); // Redirection vers la page des contacts "consulter-contacts.php"

  exit();
} else {
  echo "Erreur : aucun ID fourni.";
}
?>

<!-- 
1. Ajouter une colonne statut dans ta table contacts (si ce n’est pas déjà fait) :
sql
Copier
Modifier
ALTER TABLE contacts ADD statut ENUM('non traité', 'traité') DEFAULT 'non traité';
-->
<!--
le teste affiche: Fatal error: Uncaught PDOException: SQLSTATE[01000]: Warning: 1265 Data truncated for column 'statut' at row 1 in /var/www/html/contact/marquer-traite.php:14 Stack trace: #0 /var/www/html/contact/marquer-traite.php(14): PDOStatement->execute(Array) #1 {main} thrown in /var/www/html/contact/marquer-traite.php on line 14
-->
