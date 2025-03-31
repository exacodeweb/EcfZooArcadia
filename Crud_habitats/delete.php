<?php
// habitats/delete.php
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "ID invalide.";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM habitats WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: ./index.php");
    exit;
} else {
    echo "Erreur lors de la suppression.";
}
?>