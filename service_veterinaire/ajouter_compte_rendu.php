<?php    
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id    = $_POST['animal_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $etat_animal  = $_POST['etat_animal'];
    $nourriture   = $_POST['nourriture'];
    $grammage     = $_POST['grammage'];
    $date_visite  = $_POST['date_visite'];
    $detail_etat  = $_POST['detail_etat'];
/*comptes_rendus_veterinaires*/
    $stmt = $pdo->prepare("
        INSERT INTO rapports_veterinaires (animal_id, veterinaire_id, etat_animal, nourriture, grammage, date_visite, detail_etat) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$animal_id, $veterinaire_id, $etat_animal, $nourriture, $grammage, $date_visite, $detail_etat]);

    echo "<div class='alert alert-success text-center'>Compte-rendu ajouté avec succès.</div>";
}

// Récupérer la liste des animaux pour le menu déroulant
$stmt = $pdo->query("SELECT id, prenom FROM animaux ORDER BY prenom ASC");
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si un animal est passé en GET, le sélectionner par défaut
$selected_animal_id = $_GET['animal_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout Compte-Rendu</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-title {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Remplir un Compte-Rendu</h3>
          </div>
          <div class="card-body">

            <form method="post"> 
              <!-- Sélection de l'animal -->
              <div class="mb-3">
                <label for="animal_id" class="form-label">Sélectionnez l'animal :</label>
                <select name="animal_id" id="animal_id" class="form-control" required>
                  <option value="">-- Choisissez un animal --</option>
                  <?php foreach ($animaux as $animal): ?>
                    <option value="<?= htmlspecialchars($animal['id']) ?>" <?= ($animal['id'] == $selected_animal_id) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($animal['prenom']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <!-- ID du vétérinaire (à remplacer par celui de l'utilisateur connecté) -->
              <input type="hidden" name="veterinaire_id" value="3">
              
              <div class="mb-3">
                <label for="etat_animal" class="form-label">État de l'Animal :</label>
                <input type="text" class="form-control" id="etat_animal" name="etat_animal" required>
              </div>
              <div class="mb-3">
                <label for="nourriture" class="form-label">Nourriture Proposée :</label>
                <input type="text" class="form-control" id="nourriture" name="nourriture">
              </div>
              <div class="mb-3">
                <label for="grammage" class="form-label">Grammage (kg) :</label>
                <input type="number" class="form-control" id="grammage" name="grammage" step="0.01">
              </div>
              <div class="mb-3">
                <label for="date_visite" class="form-label">Date de Passage :</label>
                <input type="date" class="form-control" id="date_visite" name="date_visite" required>
              </div>
              <div class="mb-3">
                <label for="detail_etat" class="form-label">Détails sur l'État :</label>
                <textarea class="form-control" id="detail_etat" name="detail_etat" rows="4"></textarea>
              </div>
              <button type="submit" class="btn btn-success w-100">Enregistrer</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!--?php
session_start();
require '../config/database.php';

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées
    $animal_id     = $_POST['animal_id'] ?? '';
    $veterinaire_id = $_POST['veterinaire_id'] ?? '3'; // ici, la valeur est fixée à 3
    $etat_animal   = $_POST['etat_animal'] ?? '';
    $nourriture    = $_POST['nourriture'] ?? '';
    $grammage      = $_POST['grammage'] ?? '';
    $date_visite   = $_POST['date_visite'] ?? '';
    $detail_etat   = $_POST['detail_etat'] ?? '';

    // Préparation de l'insertion
    $stmt = $pdo->prepare("
        INSERT INTO rapports_veterinaires 
            (animal_id, veterinaire_id, etat_animal, nourriture, grammage, date_visite, detail_etat) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$animal_id, $veterinaire_id, $etat_animal, $nourriture, $grammage, $date_visite, $detail_etat]);

    $success_message = "Compte-rendu ajouté avec succès.";
}

// Récupérer la liste des animaux pour le menu déroulant
$stmt = $pdo->query("SELECT id, prenom FROM animaux ORDER BY prenom ASC");
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les comptes-rendus en effectuant des jointures pour obtenir le prénom de l'animal 
// et le nom complet du vétérinaire
$stmt = $pdo->query("
    SELECT 
        rv.date_visite, 
        a.prenom AS animal_prenom, 
        rv.etat_animal, 
        rv.nourriture, 
        rv.grammage, 
        rv.detail_etat,
        CONCAT(u.prenom, ' ', u.nom) AS veterinaire
    FROM rapports_veterinaires rv
    JOIN animaux a ON rv.animal_id = a.id
    JOIN utilisateurs u ON rv.veterinaire_id = u.id
    ORDER BY rv.date_visite DESC
");
$rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout et Historique des Comptes-Rendus</title> -->
  <!-- Bootstrap CSS --> <!--
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 20px;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="text-center mb-4">Remplir un Compte-Rendu</h2>
  <!?php if(isset($success_message)): ?>
      <div class="alert alert-success"><!?= htmlspecialchars($success_message) ?></div>
  <!?php endif; ?>
  <form method="post" class="mb-5"> -->
    <!-- Sélection de l'animal --> <!--
    <div class="mb-3">
      <label for="animal_id" class="form-label">Sélectionnez l'animal :</label>
      <select name="animal_id" id="animal_id" class="form-control" required>
        <option value="">-- Choisissez un animal --</option>
        <!?php foreach ($animaux as $animal): ?>
          <option value="<!?= htmlspecialchars($animal['id']) ?>">
            <!?= htmlspecialchars($animal['prenom']) ?>
          </option>
        <!?php endforeach; ?>
      </select>
    </div> -->
    <!-- ID du vétérinaire (fixé à 3 pour cet exemple) --> <!--
    <input type="hidden" name="veterinaire_id" value="3">
    
    <div class="mb-3">
      <label for="etat_animal" class="form-label">État de l'Animal :</label>
      <input type="text" class="form-control" id="etat_animal" name="etat_animal" required>
    </div>
    <div class="mb-3">
      <label for="nourriture" class="form-label">Nourriture Proposée :</label>
      <input type="text" class="form-control" id="nourriture" name="nourriture">
    </div>
    <div class="mb-3">
      <label for="grammage" class="form-label">Grammage (kg) :</label>
      <input type="number" class="form-control" id="grammage" name="grammage" step="0.01">
    </div>
    <div class="mb-3">
      <label for="date_visite" class="form-label">Date de Passage :</label>
      <input type="date" class="form-control" id="date_visite" name="date_visite" required>
    </div>
    <div class="mb-3">
      <label for="detail_etat" class="form-label">Détails sur l'État :</label>
      <textarea class="form-control" id="detail_etat" name="detail_etat" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-success w-100">Enregistrer</button>
  </form>
  
  <h2 class="text-center mb-4">Historique des Comptes-Rendus</h2>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>Date de Visite</th>
        <th>Animal</th>
        <th>État de l'Animal</th>
        <th>Nourriture</th>
        <th>Grammage (kg)</th>
        <th>Détails</th>
        <th>Vétérinaire</th>
      </tr>
    </thead>
    <tbody>
      <!?php foreach ($rapports as $rapport): ?>
      <tr>
        <td><!?= htmlspecialchars($rapport['date_visite']) ?></td>
        <td><!?= htmlspecialchars($rapport['animal_prenom']) ?></td>
        <td><!?= htmlspecialchars($rapport['etat_animal']) ?></td>
        <td><!?= htmlspecialchars($rapport['nourriture']) ?></td>
        <td><!?= htmlspecialchars($rapport['grammage']) ?></td>
        <td><!?= htmlspecialchars($rapport['detail_etat']) ?></td>
        <td><!?= htmlspecialchars($rapport['veterinaire']) ?></td>
      </tr>
      <!?php endforeach; ?>
    </tbody>
  </table>
</div> -->
<!-- Bootstrap JS Bundle -->   <!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html> -->





































<!--?php
$pdo = new PDO('mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4', 'utilisateur_zoo', 'Z00_Arcadia!2024');/*root*/

// Vérifier si les données sont envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $veterinaire_id = $_POST['veterinaire_id'];
    $animal_id = $_POST['animal_id'];
    $etat_animal = $_POST['etat_animal'];

    // Insérer dans la table rapports_veterinaires
    $stmt = $pdo->prepare("INSERT INTO rapports_veterinaires (veterinaire_id, animal_id, etat_animal) VALUES (?, ?, ?)");
    $stmt->execute([$veterinaire_id, $animal_id, $etat_animal]);

    echo "Compte rendu ajouté avec succès !";
}
?>
<!?php
// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4', 'utilisateur_zoo', 'Z00_Arcadia!2024');/*root*/

// Récupérer les vétérinaires
$veterinaires = $pdo->query("SELECT id, CONCAT(prenom, ' ', nom) AS nom_complet FROM utilisateurs WHERE role = 'veterinaire'")->fetchAll();
?>
<form action="ajout_compte_rendu.php" method="POST">
    <label for="veterinaire">Vétérinaire :</label>
    <select name="veterinaire_id" id="veterinaire" required>
        <option value="">-- Sélectionnez un vétérinaire --</option>
        <!?php foreach ($veterinaires as $vet) : ?>
            <option value="<!?= $vet['id'] ?>"><!?= htmlspecialchars($vet['nom_complet']) ?></option>
        <!?php endforeach; ?>
    </select>

    <label for="animal_id">Animal :</label>
    <input type="number" name="animal_id" required>

    <label for="etat_animal">État de l'animal :</label>
    <input type="text" name="etat_animal" required>

    <button type="submit">Ajouter le compte rendu</button>
</form>
        -->







<!--?php  
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['animal_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $etat_animal = $_POST['etat_animal'];
    $nourriture_proposee = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date_passage = $_POST['date_visite'];
    $details_etat = $_POST['detail_etat'];

    $stmt = $pdo->prepare("
        INSERT INTO comptes_rendus_veterinaires (animal_id, veterinaire_id, etat_animal, nourriture, grammage, date_visite, detail_etat) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$animal_id, $veterinaire_id, $etat_animal, $nourriture, $grammage, $date_visite, $detail_etat]);

    echo "<div class='alert alert-success text-center'>Compte-rendu ajouté avec succès.</div>";
}

$animal_id = $_GET['animal_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout Compte-Rendu</title> -->
  <!-- Bootstrap CSS --> <!--
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Remplir un Compte-Rendu</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <input type="hidden" name="animal_id" value="<!?= htmlspecialchars($animal_id) ?>">
              <input type="hidden" name="veterinaire_id" value="1"> --> <!-- Remplacer par l'ID du vétérinaire connecté -->
              <!--
              <div class="mb-3">
                <label for="etat_animal" class="form-label">État de l'Animal :</label>
                <input type="text" class="form-control" id="etat_animal" name="etat_animal" required>
              </div>
              <div class="mb-3">
                <label for="nourriture" class="form-label">Nourriture Proposée :</label>
                <input type="text" class="form-control" id="nourriture" name="nourriture">
              </div>
              <div class="mb-3">
                <label for="grammage" class="form-label">Grammage (kg) :</label>
                <input type="number" class="form-control" id="grammage" name="grammage" step="0.01">
              </div>
              <div class="mb-3">
                <label for="date_visite" class="form-label">Date de Passage :</label>
                <input type="date" class="form-control" id="date_visite" name="date_visite" required>
              </div>
              <div class="mb-3">
                <label for="detail_etat" class="form-label">Détails sur l'État :</label>
                <textarea class="form-control" id="detail_etat" name="detail_etat" rows="4"></textarea>
              </div>
              <button type="submit" class="btn btn-success w-100">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  
  <!-- Bootstrap JS Bundle -->   <!--
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

  -->





<!--?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['animal_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $etat_animal = $_POST['etat_animal'];
    $nourriture_proposee = $_POST['nourriture_proposee'];
    $grammage = $_POST['grammage'];
    $date_passage = $_POST['date_passage'];
    $details_etat = $_POST['details_etat'];

    $stmt = $pdo->prepare("
        INSERT INTO comptes_rendus_veterinaires (animal_id, veterinaire_id, etat_animal, nourriture_proposee, grammage, date_passage, details_etat) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$animal_id, $veterinaire_id, $etat_animal, $nourriture_proposee, $grammage, $date_passage, $details_etat]);

    echo "Compte-rendu ajouté avec succès.";
}

$animal_id = $_GET['animal_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout Compte-Rendu</title>
</head>
<body>
    <h2>Remplir un Compte-Rendu</h2>
    <form method="post">
        <input type="hidden" name="animal_id" value="<!?= $animal_id ?>">
        <input type="hidden" name="veterinaire_id" value="1"> --> <!-- Remplacer par l'ID du vétérinaire connecté -->
      <!--  <label>État de l'Animal :</label>
        <input type="text" name="etat_animal" required><br>

        <label>Nourriture Proposée :</label>
        <input type="text" name="nourriture_proposee"><br>

        <label>Grammage (kg) :</label>
        <input type="number" step="0.01" name="grammage"><br>

        <label>Date de Passage :</label>
        <input type="date" name="date_passage" required><br>

        <label>Détails sur l'État :</label>
        <textarea name="details_etat"></textarea><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
  -->

  <!--  $nourriture_proposee = $_POST['nourriture_proposee']; 
  
  -->







<!--------------------------------------------------------------------------------------------------------------->


<!--------------------------------------------------------------------------------------------------------------->

<!--
L'énoncé du chahier des charges
 L'état de l’animal
 La nourriture proposée
 Le grammage de la nourriture
 Date de passage
 Détail de l’état de l’animal (information facultative)
-->
<!--$sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";-->
