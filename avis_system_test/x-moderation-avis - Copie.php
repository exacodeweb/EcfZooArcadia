<?php
// Inclure la configuration de la base de données
require_once '../db_config.php'; // Assurez-vous que ce fichier contient les bonnes informations de connexion

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
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      /* Évite les marges par défaut du body */
    }

    /*.container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      
        max-width: 100%;
        width: 90%;
        background: #ffffff;
        /*border: 1px solid red;*/
    /*

        padding: 20px; 
      }*/

    /*--------------------------------------------*/
    /*body {
        background: beige;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0; /* Évite les marges par défaut du body */
    /*
      }*/

    /* Conteneur principal */
    .container {
      display: flex;
      flex-direction: column;
      /*justify-content: center; */
      /*border: 1px solid red;*/
    }

    /*.container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      
        max-width: 100%;
        width: 90%;
        background: #ffffff;
        /*border: 1px solid red;*/
    /*

        padding: 20px; 
      }*/

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
      background: lightgray;
      border: 1px solid black;
      border-collapse: collapse !important;
      height: 30px;
      text-align: center;
    }

    td {
      border: 1px solid black;
      height: 25px;
      padding: 5px;
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
    /*
    @media screen and (max-width: 768px) {
      /* Cache le tableau */
    /*
      table {
        display: none;
      }

      /* Affichage en cartes */
    /*
      .avis-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 100%;
      }

      .avis-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border: 1px solid black;
        text-align: center;
      }

      .avis-card p {
        margin: 5px 0;
      }

      .avis-card .btn-group {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        gap: 10px;
      }

      .btn {
        padding: 6px 10px;
        font-size: 14px;
      }
    }*/
  </style>

  <!--<style>
    body {
      background: beige;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 10px;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      max-width: 800px;
      width: 90%;
      background: #ffffff;
      border: 1px solid red;
      padding: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    /* Table par défaut */
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      tr th {
        background: lightgray;
        border: 1px solid black;
        height: 30px;
        padding: 5px;
      }

      td {
        border: 1px solid black;
        height: 25px;
        padding: 10px;
        text-align: center;
      }

      /* Boutons */
      .btn {
        padding: 6px 12px;
        margin: 2px;
      }

      .button {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
      }

      /* Mode superposé pour mobile */
      @media screen and (max-width: 768px) {
      /* Cache le tableau */
      table {
      display: none;
    }

    /* Affichage en cartes */
    .avis-container {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
    }

    .avis-card {
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      border: 1px solid black;
      text-align: center;
    }

    .avis-card p {
      margin: 5px 0;
    }

    .avis-card .btn-group {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .btn {
      padding: 6px 10px;
      font-size: 14px;
    }
    }
  </style>-->
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
              <th>ID</th>
              <th>Auteur</th>
              <th>Message</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($avisEnAttente as $avis): ?>
              <tr>
                <td><?= htmlspecialchars($avis['id']); ?></td>
                <td><?= htmlspecialchars($avis['auteur']); ?></td>
                <td><?= nl2br(htmlspecialchars($avis['message'])); ?></td>
                <td><?= htmlspecialchars($avis['date_creation']); ?></td>
                <td>
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
