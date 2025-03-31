<?php 
//require '../config/database.php';
require_once '../config/config_unv.php';

// Récupérer la liste des animaux
$animaux = $pdo->query("SELECT id, prenom, race FROM animaux ORDER BY prenom")->fetchAll(); // race
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une consommation</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center">
                        <h3>Ajouter une consommation</h3>
                    </div>
                    <div class="card-body">
                        <form action="traiter_consommation.php" method="POST">
                            <div class="mb-3">
                                <label for="animal_id" class="form-label">Animal</label>
                                <select name="animal_id" class="form-select" required>
                                    <option value="">Sélectionner un animal</option>
                                    <?php foreach ($animaux as $animal) : ?>
                                        <option value="<?= $animal['id'] ?>">
                                            <?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['race']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="heure" class="form-label">Heure</label>
                                <input type="time" name="heure" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="nourriture" class="form-label">Nourriture</label>
                                <input type="text" name="nourriture" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="quantite" class="form-label">Quantité (kg)</label>
                                <input type="number" name="quantite" step="0.1" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!--?php
require '../config/database.php';

// Récupérer la liste des animaux
$animaux = $pdo->query("SELECT id, prenom, race FROM animaux ORDER BY prenom")->fetchAll(); // race
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter une consommation</title> 
</head>

<body>
  <h2>Ajouter une consommation alimentaire</h2>

  <form action="traiter_consommation.php" method="POST">
    <label for="animal_id">Animal :</label>
    <select name="animal_id" required>
      <option value="">Sélectionner un animal</option>
      <!-?php foreach ($animaux as $animal) : ?>
        <option value="<!?= $animal['id'] ?>"><!?= $animal['prenom'] ?> (<!?= $animal['race'] ?>)</option> --> <!-- race --> <!--
      <!?php endforeach; ?>
    </select>
    <br><br>

    <label for="date">Date :</label>
    <input type="date" name="date" required>
    <br><br>

    <label for="heure">Heure :</label>
    <input type="time" name="heure" required>
    <br><br>

    <label for="nourriture">Nourriture :</label>
    <input type="text" name="nourriture" required>
    <br><br>

    <label for="quantite">Quantité (kg) :</label>
    <input type="number" name="quantite" step="0.1" required>
    <br><br>

    <button type="submit">Ajouter</button>
  </form>
</body>

</html> -->