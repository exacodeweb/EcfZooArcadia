<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

// Pagination
$avisParPage = 10;
$pageCourante = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($pageCourante - 1) * $avisParPage;

// Récupérer les avis valides  // Avis
$stmt = $pdo->prepare("SELECT message, auteur, date_creation FROM avis WHERE statut = 'valide' ORDER BY date_creation DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $avisParPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$avisValides = $stmt->fetchAll();

// Récupérer le nombre total d'avis pour calculer le nombre de pages // Avis
$totalAvis = $pdo->query("SELECT COUNT(*) FROM avis WHERE statut = 'valide'")->fetchColumn();
$totalPages = ceil($totalAvis / $avisParPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les Avis</title>
    <link rel="stylesheet" href="./assets/style.css"><!-- ../css/styles.css -->
</head>
<body>
    <section>
        <h2>Tous les Avis</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($avisValides): ?>
                        <?php foreach ($avisValides as $avis): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($avis['message']); ?></td>                              
                                <td><?php echo htmlspecialchars($avis['auteur']); ?></td>

                                <td><?php echo htmlspecialchars(strftime('%d %B %Y', strtotime($avis['date_creation']))); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucun avis disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="tous-les-avis.php?page=<?php echo $i; ?>" class="<?php echo $i === $pageCourante ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </section>
</body>
</html>

<style>
  .pagination {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    gap: 5px;
}

.pagination a {
    padding: 5px 10px;
    text-decoration: none;
    background-color: #ddd;
    color: #000;
    border-radius: 4px;
}

.pagination a.active {
    background-color: #007BFF;
    color: white;
    font-weight: bold;
}

.pagination a:hover {
    background-color: #0056b3;
    color: white;
}
</style>

