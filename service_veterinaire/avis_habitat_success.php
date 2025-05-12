<?php
$message = $_GET['message'] ?? "Opération réussie.";
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Succès</title></head>
<body>
    <h2><?= htmlspecialchars($message) ?></h2>
    <a href="avis_habitat.php">Retour</a>
</body>
</html>
