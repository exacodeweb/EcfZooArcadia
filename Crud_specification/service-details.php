<?php
//include '../includes/db-connection.php';
require_once '../config/config_unv.php'; 

// Récupérer l'ID du service depuis l'URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails du service
//$sql = "SELECT nom, description, images, specificites FROM services WHERE id = ?";
$sql = "SELECT nom, description, images, specificites FROM specifications WHERE id = ?"; // ! specificications ?
$stmt = $pdo->prepare($sql);
$stmt->execute([$serviceId]);
$service = $stmt->fetch();

if ($service) {
    echo '<div class="service-details">';
    echo '<h1>' . htmlspecialchars($service['nom']) . '</h1>';
    echo '<p>' . nl2br(htmlspecialchars($service['description'])) . '</p>';

    // Afficher les images du service
    $images = json_decode($service['images']);
    echo '<div class="images">';
    foreach ($images as $image) {
        echo '<img src="../assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
    }
    echo '</div>';

    // Afficher les spécificités du service sous forme de liste
    if (!empty($service['specificites'])) {
        echo '<h2>Spécificités</h2>';
        echo '<ul>';
        $specificites = explode("\n", $service['specificites']);
        foreach ($specificites as $spec) {
            echo '<li>' . htmlspecialchars($spec) . '</li>';
        }
        echo '</ul>';
    }

    echo '</div>';
} else {
    echo '<p class="error">Service non trouvé.</p>';
}
?> 



<br>


<!--?php 
require_once '../config/config_unv.php';

// Récupérer l'ID du service depuis l'URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails du service
$sql = "SELECT nom, description, images, specificites FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$serviceId]);
$service = $stmt->fetch();

if ($service) {
    echo '<div class="service-details">';
    echo '<h1>' . htmlspecialchars($service['nom']) . '</h1>';
    echo '<p>' . nl2br(htmlspecialchars($service['description'])) . '</p>';

    // Afficher les images du service
    $images = json_decode($service['images']);
    if (!empty($images)) {
        echo '<div class="images">';
        foreach ($images as $image) {
            echo '<img src="../assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
        }
        echo '</div>';
    }

    // Afficher les spécificités du service sous forme de liste
    if (!empty($service['specificites'])) {
        echo '<h2>Spécificités</h2>';
        echo '<ul>';
        $specificites = explode("\n", $service['specificites']);
        foreach ($specificites as $spec) {
            echo '<li>' . htmlspecialchars($spec) . '</li>';
        }
        echo '</ul>';
    }

    echo '</div>';
} else {
    echo '<p class="error">Service non trouvé.</p>';
}
?>
-->
