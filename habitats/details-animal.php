<?php
//include '../includes/db-connection.php';
require_once '../config/config_unv.php'; // a testé

// Récupérer l'ID depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?"; // espece
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en, fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'animal</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 32px;
      color: #2c3e50;
      margin-bottom: 10px;
      text-align: center;
    }

    .animal-images {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }

    .animal-images img {
      width: 150px;
      height: auto;
      border-radius: 8px;
      border: 2px solid #ddd;
      transition: transform 0.3s ease;
    }

    .animal-images img:hover {
      transform: scale(1.1);
      border-color: #3498db;
    }

    .reports-section {
      margin-top: 40px;
    }

    h2 {
      font-size: 28px;
      color: #34495e;
      margin-bottom: 20px;
      text-align: center;
    }

    .report-card {
      background-color: #f9f9f9;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .report-card p {
      margin: 5px 0;
    }

    .report-card strong {
      color: #2c3e50;
    }

    .error {
      color: #e74c3c;
      font-weight: bold;
      text-align: center;
      margin-top: 30px;
    }

  </style>
</head>

<body>

  <script>
    // Recherche et filtres dynamiques habitat par nom  TEST
    const searchInput = document.getElementById('search-habitat');
  searchInput.addEventListener('input', () => {
      const query = searchInput.value.toLowerCase();
      document.querySelectorAll('.habitat-card').forEach(card => {
          const name = card.querySelector('h3').textContent.toLowerCase();
          card.style.display = name.includes(query) ? '' : 'none';
      });
  });
  </script>


  <div class="container">
    <?php if ($animal): ?>

      <div class="animal-details">
        <h1><?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['race']) ?>)</h1><!-- espece -->
        <div class="animal-images">
          <?php
          $images = json_decode($animal['images']);
          foreach ($images as $image):
          ?>
            <img src="../assets/images/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($animal['prenom']) ?>" onerror="this.src='../assets/images/placeholder.jpg';">
            <?php endforeach; ?>
        </div>
      </div>

      <div class="reports-section">
        <h2>Rapports vétérinaires</h2>
        <?php
        $sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
        $stmtReports = $pdo->prepare($sqlReports);
        $stmtReports->execute([$animalId]);
        while ($report = $stmtReports->fetch()):
        ?>
          <div class="report-card">
            <p><strong>État :</strong> <?= htmlspecialchars($report['etat']) ?></p>
            <p><strong>Nourriture :</strong> <?= htmlspecialchars($report['nourriture']) ?> (<?= $report['grammage'] ?> g)</p>
            <p><strong>Date :</strong> <?= htmlspecialchars($report['date']) ?></p>
            <?php if ($report['detail_etat']): ?>
              <p><strong>Détails :</strong> <?= htmlspecialchars($report['detail_etat']) ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>

    <?php else: ?>
      <p class="error">Animal non trouvé.</p>
    <?php endif; ?>

  </div>
</body>

</html>


<!--?php
include 'includes/db-connection.php';

$animal_id = $_GET['id'];
$query = $pdo->prepare("
    SELECT a.prenom, a.race, a.images, h.nom AS habitat_nom,
           r.etat, r.nourriture, r.grammage, r.date, r.detail_etat
    FROM animaux a
    LEFT JOIN habitats h ON a.habitat_id = h.id
    LEFT JOIN rapports_veterinaires r ON a.id = r.animal_id
    WHERE a.id = :id
");
$query->execute(['id' => $animal_id]);
$animal_details = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Animal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><!?= htmlspecialchars($animal_details[0]['prenom']) ?> (<!?= htmlspecialchars($animal_details[0]['race']) ?>)</h1>
    <div class="animal-images">
        <!?php foreach (json_decode($animal_details[0]['images']) as $image): ?>
            <img src="<!?= $image ?>" alt="Image de l'animal">
        <!?php endforeach; ?>
    </div>
    <p><strong>Habitat :</strong> <!?= htmlspecialchars($animal_details[0]['habitat_nom']) ?></p>
    <h2>Rapports vétérinaires :</h2>
    <!?php foreach ($animal_details as $detail): ?>
        <div class="veterinary-report">
            <p><strong>Date :</strong> <!?= htmlspecialchars($detail['date']) ?></p>
            <p><strong>État :</strong> <!?= htmlspecialchars($detail['etat']) ?></p>
            <p><strong>Nourriture :</strong> <!?= htmlspecialchars($detail['nourriture']) ?> (<!?= htmlspecialchars($detail['grammage']) ?> g)</p>
            <p><strong>Détail :</strong> <!?= htmlspecialchars($detail['detail_etat'] ?: 'Non spécifié') ?></p>
        </div>
    <!?php endforeach; ?>

<script>
  // Masquer/afficher les détails de l’état d’un animal
  document.querySelectorAll('.animal-state-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const details = button.nextElementSibling;
        details.style.display = details.style.display === 'none' ? 'block' : 'none';
    });
});
</script>

<script>
  // Recherche et filtres dynamiques habitat par nom
  const searchInput = document.getElementById('search-habitat');
searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    document.querySelectorAll('.habitat-card').forEach(card => {
        const name = card.querySelector('h3').textContent.toLowerCase();
        card.style.display = name.includes(query) ? '' : 'none';
    });
});
</script>

</body>
</html> -->

<!--------------------------------------------------------- celui-ci fonctionne --------------------------------------->
<!--?php
include 'includes/db-connection.php';

// Récupérer l'ID depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();

if ($animal) {
    echo '<h1>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h1>';
    $images = json_decode($animal['images']);
    foreach ($images as $image) {
        echo '<img src="assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
    }

    // Récupérer les rapports vétérinaires
    $sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Rapports vétérinaires</h2>';
    while ($report = $stmtReports->fetch()) {
        echo '<p>État : ' . htmlspecialchars($report['etat']) . '</p>';
        echo '<p>Nourriture : ' . htmlspecialchars($report['nourriture']) . ' (' . $report['grammage'] . ' g)</p>';
        echo '<p>Date : ' . htmlspecialchars($report['date']) . '</p>';
        if ($report['detail_etat']) {
            echo '<p>Détails : ' . htmlspecialchars($report['detail_etat']) . '</p>';
        }
    }
} else {
    echo '<p>Animal non trouvé.</p>';
}
?> -->

<!--------------------------------------------------------------------------------------------------------------------->

<!--!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Habitat</title>
    <link rel="stylesheet" href="assets/css/styles.css">

  <style>
    /* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    text-align: center;
    color: #2c3e50;
}

/* Habitat Details Section */
.habitat-details {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.habitat-details p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

/* Images Section */
.images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-top: 20px;
}

.images img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-height: 200px;
}

/* Animal List Section */
.animal-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.animal-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 200px;
    text-align: center;
    padding: 15px;
}

.animal-card img {
    width: 100%;
    border-radius: 8px;
    height: auto;
    max-height: 150px;
}

.animal-card h3 {
    font-size: 18px;
    margin: 10px 0;
    color: #2c3e50;
}

.animal-card .btn {
    display: inline-block;
    padding: 10px 15px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    font-size: 14px;
}

.animal-card .btn:hover {
    background: #2980b9;
}

/* Error Message */
.error {
    text-align: center;
    color: #e74c3c;
    font-size: 18px;
}
  </style>

</head>
<body>
    <div class="container">
        <!?php
        include 'includes/db-connection.php';

        // Récupérer l'ID depuis l'URL
        $habitatId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Récupérer les détails de l'habitat
        $sql = "SELECT nom, description, images FROM habitats WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$habitatId]);
        $habitat = $stmt->fetch();

        if ($habitat) {
            echo '<div class="habitat-details">';
            echo '<h1>' . htmlspecialchars($habitat['nom']) . '</h1>';
            echo '<p>' . htmlspecialchars($habitat['description']) . '</p>';
            
            // Afficher les images
            $images = json_decode($habitat['images']);
            echo '<div class="images">';
            foreach ($images as $image) {
                echo '<img src="assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($habitat['nom']) . '">';
            }
            echo '</div>';
            echo '</div>';

            // Afficher les animaux associés
            echo '<h2>Animaux dans cet habitat</h2>';
            $sqlAnimals = "SELECT id, prenom, race, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM animaux WHERE habitat_id = ?";
            $stmtAnimals = $pdo->prepare($sqlAnimals);
            $stmtAnimals->execute([$habitatId]);

            echo '<div class="animal-list">';
            while ($animal = $stmtAnimals->fetch()) {
                echo '<div class="animal-card">';
                echo '<img src="assets/images/' . $animal['image'] . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
                echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';
                echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">Habitat non trouvé.</p>';
        }
        ?>
    </div>
</body>
</html>-->

<!--------------------------------------------------------------------------------------------------------------------->