<?php
/*session_start();
$pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "Z00_Arcadia!2024", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);*/

require_once '../config/config_unv.php';
//require '../config/database.php';

// Pagination
$avisParPage = 10;
$pageCourante = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($pageCourante - 1) * $avisParPage;

// Récupérer les avis valides
$stmt = $pdo->prepare("SELECT message, auteur, date_creation FROM avis WHERE statut = 'approuve' ORDER BY date_creation DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $avisParPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$avisValides = $stmt->fetchAll();

// Récupérer le nombre total d'avis pour calculer le nombre de pages
$totalAvis = $pdo->query("SELECT COUNT(*) FROM avis WHERE statut = 'approuve'")->fetchColumn();
$totalPages = ceil($totalAvis / $avisParPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tous les Avis | Zoo Arcadia</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-100 text-gray-900">
  <div class="max-w-4xl mx-auto py-10">
    <h2 class="text-3xl font-bold text-center mb-6">Tous les Avis</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
      <table class="min-w-full border-collapse">
        <thead>
          <tr class="bg-blue-500 text-white">
            <th class="p-3 text-left">Auteur</th>
            <th class="p-3 text-left">Message</th>
            <th class="p-3 text-left">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($avisValides): ?>
            <?php foreach ($avisValides as $avis): ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="p-3 font-semibold"><?php echo htmlspecialchars($avis['auteur']); ?></td>
                <td class="p-3"><?php echo htmlspecialchars($avis['message']); ?></td>
                <td class="p-3 text-sm text-gray-600"><?php echo date('d/m/Y', strtotime($avis['date_creation'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="p-4 text-center text-gray-500">Aucun avis disponible.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center space-x-2">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="tous-les-avis.php?page=<?php echo $i; ?>"
          class="px-4 py-2 rounded-md border 
                          <?php echo $i === $pageCourante ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-blue-100'; ?>">
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>
    </div>
  </div>
</body>

</html>