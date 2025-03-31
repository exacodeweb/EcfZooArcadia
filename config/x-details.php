<?php
include 'includes/db-connection.php';
//require_once '../config/database.php';

// Récupérer l'ID de l'animal depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;


// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();

if ($animal) {
    echo '<div class="animal-details">';
    echo '<h1>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h1>';

    // Afficher les images de l'animal
    $images = json_decode($animal['images']);
    echo '<div class="animal-images">';
    foreach ($images as $image) {
        echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
    }
    echo '</div>';
    echo '</div>';

    // Récupérer les comptes rendus vétérinaires associés à cet animal
    $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Comptes Rendus Vétérinaires</h2>';
    echo '<div class="reports-section">';
    while ($report = $stmtReports->fetch()) {
        echo '<div class="report-card">';
        echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date_visite']) . '</p>';
        echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat_animal']) . '</p>';
        echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
        if (!empty($report['detail_etat'])) {
            echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
        }
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="error">Animal non trouvé.</p>';
}
?>