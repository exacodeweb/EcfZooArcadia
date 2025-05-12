<?php
$error = $_GET['error'] ?? "Une erreur est survenue.";
?>
<!DOCTYPE html>
<html lang="fr">
<head><title>Erreur</title></head>
<body>
    <h2 style="color:red"><?= htmlspecialchars($error) ?></h2>
    <a href="avis_habitat.php">Retour</a>
</body>
</html>
