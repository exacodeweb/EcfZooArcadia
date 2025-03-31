<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once '../config/config_unv.php';

// Récupérer tous les animaux
$sql = "SELECT a.id, a.prenom, a.race, a.images, h.nom AS habitat_nom
        FROM animaux a
        JOIN habitats h ON a.habitat_id = h.id";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Animaux</title>
  <link rel="stylesheet" href="../assets/css/styles.css">

  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


  <style>
    /* Conteneur principal */
    .container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    /* Table responsive */
    .table-container {
      width: 100%;
      overflow-x: auto;
    }

    /* Tableau classique */
    .animal-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }

    /* En-tête du tableau */
    .animal-table thead {
      background-color: #333;
      color: white;
    }

    /* Cellules */
    .animal-table th,
    .animal-table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    /* Actions */
    .action .btn {
      margin: 2px;
    }

    /* Boutons d'action */
    .info-btn {
      background: #17a2b8;
      color: white;
    }

    .edit-btn {
      background: #ffc107;
      color: black;
    }

    .delete-btn {
      background: #dc3545;
      color: white;
    }

    /* Effet hover */
    .btn:hover {
      opacity: 0.8;
    }

    /* ✅ Mode responsive : transformation du tableau en cartes */
    @media (max-width: 600px) {
      .table-container {
        display: block;
      }

      .animal-table,
      .animal-table thead,
      .animal-table tbody,
      .animal-table tr,
      .animal-table td {
        display: block;
        width: 100%;
      }

      /* On cache l'en-tête du tableau */
      .animal-table thead {
        display: none;
      }

      /* Chaque ligne devient une "carte" */
      .animal-table tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 8px;
        background: white;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
      }

      /* On affiche chaque cellule en mode bloc */
      .animal-table td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ddd;
      }

      /* La dernière cellule ne doit pas avoir de bordure */
      .animal-table td:last-child {
        border-bottom: none;
      }

      /* Ajout d'un pseudo-élément pour afficher le nom des colonnes */
      .animal-table td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #333;
      }

      /* Centrage des boutons */
      .action {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
      }
    }
  </style>

</head>

<body>

  <div class="container">
    <h1 class="title">Liste des Animaux</h1>

    <div class="button-group">
      <a href="../pages/admin_dashboard.php" class="btn back-btn">⬅ Retour</a>
      <a href="ajouter.php" class="btn add-btn">+ Ajouter un nouvel animal</a>
    </div>

    <div class="table-container">
      <table class="animal-table">
        <thead>

          <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Race</th>
            <th>Habitat</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($animaux as $animal): ?>
            <tr>
              <td data-label="ID"><?= htmlspecialchars($animal['id']) ?></td>
              <td data-label="Prénom"><?= htmlspecialchars($animal['prenom']) ?></td>
              <td data-label="Race"><?= htmlspecialchars($animal['race']) ?></td>
              <td data-label="Habitat"><?= htmlspecialchars($animal['habitat_nom']) ?></td>
              <td data-label="Actions" class="action">
                <a href="details.php?id=<?= $animal['id'] ?>" class="btn info-btn">Voir</a>
                <a href="modifier.php?id=<?= $animal['id'] ?>" class="btn edit-btn">Modifier</a>
                <a href="supprimer.php?id=<?= $animal['id'] ?>" class="btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
    <!--</div>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>