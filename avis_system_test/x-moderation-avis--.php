<?php
// Inclure la configuration de la base de données
require_once 'db_config.php';

// Récupérer les avis en attente
try {
    $stmt = $pdo->prepare("SELECT * FROM avis_2 WHERE statut = 'en_attente' ORDER BY date_creation DESC");
    $stmt->execute();
    $avisEnAttente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des avis : " . $e->getMessage());
}

// Script: Gérer la modération des avis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['action'])) {
    $id = (int) $_POST['id'];
    $action = $_POST['action'];

    //if ($action === 'approuver') {
       // $query = "UPDATE avis_2 SET statut = 'approuve' WHERE id = :id";
    //} elseif ($action === 'refuser') {
      //  $query = "DELETE FROM avis_2 WHERE id = :id"; // Supprime directement les avis refusés
   // }

    if ($action === 'approuver') {
      $query = "UPDATE avis_2 SET statut = 'approuve' WHERE id = :id";
  } elseif ($action === 'refuser') {
      $query = "UPDATE avis_2 SET statut = 'refuse' WHERE id = :id"; // Met le statut à "refusé"
  }


    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        header("Location: modération.php"); // Recharge la page après la mise à jour
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour : " . $e->getMessage());
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
</head>
<body>
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
                        <td><?= htmlspecialchars($avis['message']); ?></td>
                        <td><?= htmlspecialchars($avis['date_creation']); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $avis['id']; ?>">
                                <button type="submit" name="action" value="approuver" class="btn btn-success">Approuver</button>
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

    <!--<a href="tableau_de_bord.php" class="btn btn-primary">Retour au tableau de bord</a>-->
    <a href="../pages/employe_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
</body>
</html>




















<!--?php
// Inclure la configuration de la base de données
require 'db_config.php';

// Vérifier si une action a été effectuée (approuver ou refuser un avis)
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    //$id = intval($_POST['id']);
    //$action = $_POST['action'];

// Vérifier si une action a été effectuée (approuver ou refuser un avis)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'] === 'approuve' ? 'approuve' : 'refuse';



    //if (isset($_POST['action']) && isset($_POST['id'])) {
      //$id = $_POST['id'];
      //if ($_POST['action'] === 'approuver') {
        //  $stmt = $pdo->prepare("UPDATE avis_2 SET statut = 'approuve' WHERE id = :id");
      //} elseif ($_POST['action'] === 'refuser') {
      //    $stmt = $pdo->prepare("DELETE FROM avis_2 WHERE id = :id"); // Supprime les refusés
    //  }
      //$stmt->execute([':id' => $id]);
  //}



    try {
        if ($action === 'approuve') {
            // Mettre à jour le statut à "approuvé"
            $stmt = $pdo->prepare("UPDATE avis_2 SET statut = 'approuve' WHERE id = :id");
        } elseif ($action === 'refuse') {
            // Supprimer l'avis de la table
            $stmt = $pdo->prepare("DELETE FROM avis_2 WHERE id = :id");
        }
        $stmt->execute([':id' => $id]);
        echo "L'avis a été traité avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Récupérer les avis en attente
try {
    $stmt = $pdo->prepare("SELECT * FROM avis_2 WHERE statut IS NULL");
    $stmt->execute();
    $avis_en_attente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $avis_en_attente = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération des Avis</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Modération des Avis</h1>

    <!?php if (count($avis_en_attente) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Avis</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!?php foreach ($avis_en_attente as $avis): ?>
                    <tr>
                        <td><!?= htmlspecialchars($avis['auteur']) ?></td>
                        <td><!?= htmlspecialchars($avis['message']) ?></td>
                        <td><!?= htmlspecialchars($avis['date_creation']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id'] ?>">
                                <button type="submit" name="action" value="approuve">Approuver</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id'] ?>">
                                <button type="submit" name="action" value="refuse">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <!?php endforeach; ?>
            </tbody>
        </table>
    <!?php else: ?>
        <p>Tous les avis ont été modérés.</p>  -->
        <!--<a href="dashboard-employe.php">Retour au tableau de bord</a>--> <!--
        <a href="../pages/employe_dashboard.php">Retour au tableau de bord</a>  -->
    <!--?php endif; ?>
</body>
</html>
    -->









<!--?php
// Inclure la configuration de la base de données
require 'db_config.php';

// Vérifier si une action a été effectuée (approuver ou refuser un avis)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'] === 'approuve' ? 'approuve' : 'refuse';

    try {
        $stmt = $pdo->prepare("UPDATE avis_2 SET statut = :statut WHERE id = :id");
        $stmt->execute([':statut' => $action, ':id' => $id]);
        echo "L'avis a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Récupérer les avis en attente
try {
    $stmt = $pdo->prepare("SELECT * FROM avis_2 WHERE statut = 'en_attente'");
    $stmt->execute();
    $avis_en_attente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $avis_en_attente = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération des Avis</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Modération des Avis</h1>

    <!?php if (count($avis_en_attente) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Avis</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!?php foreach ($avis_en_attente as $avis): ?>
                    <tr>
                        <td><!?= htmlspecialchars($avis['auteur']) ?></td>
                        <td><!?= htmlspecialchars($avis['message']) ?></td>
                        <td><!?= htmlspecialchars($avis['date_creation']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id'] ?>">
                                <button type="submit" name="action" value="approuve">Approuver</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id'] ?>">
                                <button type="submit" name="action" value="refuse">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <!?php endforeach; ?>
            </tbody>
        </table>
    <!?php else: ?>
        <p>Aucun avis en attente de modération.</p>
    <!?php endif; ?>
</body>
</html>

?>











<!-?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // 'valider' ou 'rejeter'
    $avisId = $_POST['id'];

    try {
        if ($action === 'valider') {
            $stmt = $pdo->prepare("UPDATE avis_2 SET statut = 'valide' WHERE id = ?");
        } elseif ($action === 'rejeter') {
            $stmt = $pdo->prepare("UPDATE avis_2 SET statut = 'rejete' WHERE id = ?");
        }

        $stmt->execute([$avisId]);
        echo "Avis mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Récupérer les avis en attente
$stmt = $pdo->prepare("SELECT * FROM avis_2 WHERE statut = 'en_attente'");
$stmt->execute();
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération des Avis</title>
</head>
<body>
    <h2>Modération des Avis</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Auteur</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!?php foreach ($avis as $avi): ?>
                <tr>
                    <td><!?= htmlspecialchars($avi['id']) ?></td>
                    <td><!?= htmlspecialchars($avi['auteur']) ?></td>
                    <td><!?= htmlspecialchars($avi['message']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<!?= $avi['id'] ?>">
                            <button type="submit" name="action" value="valider">Valider</button>
                            <button type="submit" name="action" value="rejeter">Rejeter</button>
                        </form>
                    </td>
                </tr>
            <!?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>