<?php
require_once '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO Services (nom, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $nom, $description);

    if ($stmt->execute()) {
        echo "Service ajouté avec succès.";
    } else {
        echo "Erreur : " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>