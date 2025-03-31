<?php
// Inclure la configuration de la base de données
//require_once '../db_config.php'; // Assurez-vous que ce fichier contient les bonnes informations de connexion
require_once '../config/config_unv.php';

// Récupérer les avis en attente
try {
  $stmt = $pdo->prepare("SELECT * FROM avis WHERE statut = 'en_attente' ORDER BY date_creation DESC");
  $stmt->execute();
  $avisEnAttente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erreur lors de la récupération des avis : " . htmlspecialchars($e->getMessage()));
}

// Gérer la modération des avis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['action'])) {
  $id = (int) $_POST['id'];
  $action = $_POST['action'];

  if ($action === 'approuver') {
    $query = "UPDATE avis SET statut = 'approuve' WHERE id = :id";
  } elseif ($action === 'refuser') {
    $query = "UPDATE avis SET statut = 'refuse' WHERE id = :id";
  } else {
    die("Action invalide.");
  }

  try {
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    header("Location: ./moderation-avis.php"); // Recharge la page après la mise à jour
    exit;
  } catch (PDOException $e) {
    die("Erreur lors de la mise à jour : " . htmlspecialchars($e->getMessage()));
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modération des Avis</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">

  <style>
    body {
      background: beige;
      height: auto;
      /*100vh*/
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      /* Évite les marges par défaut du body */
    }

    /* Conteneur principal */
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      /**/
      /*border: 1px solid red;*/
      /*align-items: center;*/
    }

    .content {
      /*max-width: 1000px;*/
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 100%;
      width: 90%;
      /*border: dashed orange 8px;*/
    }

    /* Titres */
    h1 {
      color: #343a40;
      text-align: center;
      margin-bottom: 20px;
    }

    p {
      text-align: center;
    }

    tr th {
      background: black;
      /*lightgray*/
      color: white;
      border: 1px solid black;
      border-collapse: collapse !important;
      height: 40px;
      /*30px*/
      text-align: center;
    }

    td {
      border: 1px solid black;
      height: 25px;
      padding: 5px;
      text-align: center;
    }

    .button {
      margin-top: 30px;
      /*align-items: center;*/
      /*justify-content: center;*/
      align-self: center;
      /*display: flex;
      flex-direction: column;
      align-items: center;*/
    }

    .btn-form {
      display: flex;
      align-items: center;
      height: auto;
      justify-content: center;
      gap: 5px;

      /*border: black;*/
    }

    .button .btn {
      padding: 4px 8px;
    }

    a .btn .btn-primary {
      background-color: #28a745;
      padding-top: 30px !important;
    }

    /* Mobile */
    @media screen and (max-width: 480px) {
      .container {
        width: 100%;
        padding: 10px;
      }

      table {
        font-size: 12px;
      }

      tr th,
      td {
        font-size: 12px;
        padding: 5px;
      }

      .btn {
        width: 100%;
        /* Boutons en pleine largeur */
        text-align: center;
      }
    }

    /* Mode superposé pour mobile */
  </style>
</head>

<body>

  <section class="content"><!-- container -->
    <div class="container">
      <h1>Modération des Avis</h1>
      <p>Validez ou refusez les avis soumis par les utilisateurs.</p>

      <?php if (!empty($avisEnAttente)): ?>
        <table>
          <thead>
            <tr>
              <!--<th>ID</th>-->
              <th>Auteur</th>
              <th>Message</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($avisEnAttente as $avis): ?>
              <tr>
                <!--<td><!?= htmlspecialchars($avis['id']); ?></td>-->
                <td><?= htmlspecialchars($avis['auteur']); ?></td>
                <td><?= nl2br(htmlspecialchars($avis['message'])); ?></td>
                <td><?= htmlspecialchars($avis['date_creation']); ?></td>
                <td class="btn-form">
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $avis['id']; ?>">
                    <button type="submit" name="action" value="approuver" class="btn btn-warning">Approuver</button>
                  </form>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $avis['id']; ?>">
                    <button type="submit" name="action" value="refuser" class="btn btn-danger">Refuser</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>Aucun avis en attente de modération.</p>
      <?php endif; ?>

      <div class="button">
        <!--<a href="../pages/employe_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>-->
        <a href="../pages/employe_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>