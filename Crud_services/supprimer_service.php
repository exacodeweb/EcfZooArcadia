<?php
//include 'config.php';
//include '../config/database.php';
require_once '../config/config_unv.php';

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    if ($stmt->execute([$_GET["id"]])) {
        echo "Habitat supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
}
?>
<a href="liste_services.php">Retour</a>