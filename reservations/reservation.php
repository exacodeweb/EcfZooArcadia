<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4', 'utilisateur_zoo', 'Z00_Arcadia!2024');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des types de visite depuis la base
$typesVisite = $pdo->query("SELECT * FROM types_visite")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réserver une visite - Zoo Arcadia</title>
</head>
<body>
  <h1>Réservation de billets</h1>

  <form action="traitement_reservation.php" method="POST">
    <label>Nom complet :</label><br>
    <input type="text" name="nom_visiteur" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Date de visite :</label><br>
    <input type="date" name="date_visite" required><br><br>

    <label>Type de visite :</label><br>
    <select name="type_visite" required>
      <?php foreach ($typesVisite as $type): ?>
        <option value="<?= htmlspecialchars($type['nom_type']) ?>">
          <?= htmlspecialchars($type['nom_type']) ?>
        </option>
      <?php endforeach; ?>
    </select><br><br>

    <label>Nombre d'adultes :</label><br>
    <input type="number" name="nb_adultes" min="0" value="1" required><br><br>

    <label>Nombre d'enfants :</label><br>
    <input type="number" name="nb_enfants" min="0" value="0"><br><br>

    <label>Nombre d'étudiants :</label><br>
    <input type="number" name="nb_etudiants" min="0" value="0"><br><br>

    <button type="submit">Réserver</button>
  </form>
</body>
</html>
