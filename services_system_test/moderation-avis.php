<?php  
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
        header("Location: moderation-avis.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
          /*min-height: 100vh;*/
          /*padding-top: 80px; /* Ajustez selon la hauteur de la barre de recherche */
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;/*900px*/
        }
        .table-responsive {
            overflow-x: auto;
        }
        .btn {
            min-width: 100px;
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #dee2e6;
                border-radius: 10px;
                padding: 10px;
                background: #fff;
            }
            .table tbody td {
                display: block;
                text-align: right;
                font-size: 14px;
                border-bottom: 1px solid #dee2e6;
                padding: 8px;
            }
            .table tbody td:last-child {
                border-bottom: none;
            }
            .table tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Modération des Avis</h1>
    <p class="text-center text-muted">Validez ou refusez les avis soumis par les utilisateurs.</p>

    <?php if (!empty($avisEnAttente)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                            <td data-label="ID"><?= htmlspecialchars($avis['id']); ?></td>
                            <td data-label="Auteur"><?= htmlspecialchars($avis['auteur']); ?></td>
                            <td data-label="Message"><?= nl2br(htmlspecialchars($avis['message'])); ?></td>
                            <td data-label="Date"><?= htmlspecialchars($avis['date_creation']); ?></td>
                            <td data-label="Actions" class="text-center">
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $avis['id']; ?>">
                                    <button type="submit" name="action" value="approuver" class="btn btn-success btn-sm">Approuver</button>
                                </form>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $avis['id']; ?>">
                                    <button type="submit" name="action" value="refuser" class="btn btn-danger btn-sm">Refuser</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Aucun avis en attente de modération.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../pages/admin_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!--?php 
// Inclure la configuration de la base de données
//require_once '../db_config.php'; // Assurez-vous que ce fichier contient les bonnes informations de connexion
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
        header("Location: moderation-avis.php"); // Recharge la page après la mise à jour
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
    <title>Modération des Avis</title>  -->
    <!--<link rel="stylesheet" href="styles.css">-->  <!--
</head>
<body>
    <h1>Modération des Avis</h1>
    <p>Validez ou refusez les avis soumis par les utilisateurs.</p>

    <!?php if (!empty($avisEnAttente)): ?>
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
                <!?php foreach ($avisEnAttente as $avis): ?>
                    <tr>
                        <td><!?= htmlspecialchars($avis['id']); ?></td>
                        <td><!?= htmlspecialchars($avis['auteur']); ?></td>
                        <td><!?= nl2br(htmlspecialchars($avis['message'])); ?></td>
                        <td><!?= htmlspecialchars($avis['date_creation']); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id']; ?>">
                                <button type="submit" name="action" value="approuver" class="btn btn-success">Approuver</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<!?= $avis['id']; ?>">
                                <button type="submit" name="action" value="refuser" class="btn btn-danger">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <!?php endforeach; ?>
            </tbody>
        </table>
    <!?php else: ?>
        <p>Aucun avis en attente de modération.</p>
    <!?php endif; ?>  -->

    <!--<a href="../pages/employe_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>--> <!--
    <a href="../pages/admin_dashboard.php" class="btn btn-primary">Reour au tableau de bord</a>
</body>
</html>
