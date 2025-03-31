<?php
// Connexion à la base de données
require_once '../db_config.php';

$sql = "SELECT nom, description FROM Services";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='service-card'>";
        echo "<h3>" . htmlspecialchars($row['nom']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun service disponible pour le moment.</p>";
}
$conn->close();
?>