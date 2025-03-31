<?php
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];

    // Récupérer l'image actuelle
    $stmt = $pdo->prepare("SELECT images FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImages = json_decode($service["images"], true);

    // Vérifier si une nouvelle image a été envoyée
    if (!empty($_POST["images"])) {
        $images = json_encode([$_POST["images"]]);
    } else {
        $images = json_encode($currentImages); // Garde l'image actuelle
    }

    // Mise à jour des données
    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>




<!--?php
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = isset($_POST["images"]) && !empty($_POST["images"]) ? json_encode([$_POST["images"]]) : json_encode([]);

    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>