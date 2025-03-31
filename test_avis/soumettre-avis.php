<?php
$conn = new mysqli("db", "utilisateur_zoo", "Z00_Arcadia!2024", "zoo_arcadia"); //localhost //root //G1i9e6t3

if ($conn->connect_error) {
  die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifiez que les champs POST sont définis
if (isset($_POST['auteur']) && isset($_POST['message'])) {
  $auteur = htmlspecialchars($_POST['auteur']);
  $message = htmlspecialchars($_POST['message']);

  $sql = "INSERT INTO avis (message, auteur, statut) VALUES (?, ?, 'en_attente')"; // Avis changer en avis
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $message, $auteur);

  if ($stmt->execute()) {
    echo "Merci pour votre avis ! Il sera modéré avant d'être publié.";
  } else {
    echo "Erreur : " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Erreur : Tous les champs sont requis.";
}

$conn->close();
