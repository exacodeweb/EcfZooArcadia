<?php 
//require_once '../config/database.php';
require_once '../config/config_unv.php';

// Récupérer les habitats pour le menu déroulant
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$prenom = $race = $habitat_id = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des champs
    if (empty($_POST["prenom"])) {
        $errors['prenom'] = "Le prénom est requis.";
    } else {
        $prenom = $_POST["prenom"];
    }

    if (empty($_POST["race"])) {
        $errors['race'] = "La race est requise.";
    } else {
        $race = $_POST["race"];
    }

    if (empty($_POST["habitat_id"])) {
        $errors['habitat_id'] = "L'habitat est requis.";
    } else {
        $habitat_id = $_POST["habitat_id"];
    }

    // Traitement des images
    $imagesArray = [];
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = '../assets/images/';
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($tmpName, $filePath)) {
                $imagesArray[] = $fileName;
            } else {
                $errors['images'] = "Erreur lors de l'upload de l'image.";
            }
        }
    }

    // Insertion dans la base de données (uniquement si la requête est en POST)
    if (empty($errors)) {
        $sql = "UPDATE animaux (prenom, race, images, habitat_id) VALUES (:prenom, :race, :images, :habitat_id)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':prenom' => $prenom,
            ':race' => $race,
            ':images' => json_encode($imagesArray),
            ':habitat_id' => $habitat_id
        ])) {
            header("Location: index.php");
            exit;
        } else {
            $errors['general'] = "Une erreur est survenue lors de l'ajout.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un Habitat</title>
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .error {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white"><!-- bg-primary -->
            <h3 class="card-title mb-0 text-center">Ajouter un Animal</h3>
          </div>
          <div class="card-body">
            <?php if (!empty($errors['general'])): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
            <?php endif; ?>
            <form action="ajouter.php" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($prenom) ?>">
                <?php if (!empty($errors['prenom'])): ?>
                  <div class="text-danger small"><?= htmlspecialchars($errors['prenom']) ?></div>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="race" class="form-label">Espèce :</label><!-- Race -->
                <input type="text" name="race" id="race" class="form-control" value="<?= htmlspecialchars($race) ?>">
                <?php if (!empty($errors['race'])): ?>
                  <div class="text-danger small"><?= htmlspecialchars($errors['race']) ?></div>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="habitat_id" class="form-label">Habitat :</label><!-- Habitat -->
                <select name="habitat_id" id="habitat_id" class="form-select">
                  <option value="">--Sélectionner un habitat--</option><!-- habitat -->
                  <?php foreach ($habitats as $habitat): ?>
                    <option value="<?= $habitat['id'] ?>" <?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
                      <?= htmlspecialchars($habitat['nom']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['habitat_id'])): ?>
                  <div class="text-danger small"><?= htmlspecialchars($errors['habitat_id']) ?></div>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="images" class="form-label">Images :</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
                <?php if (!empty($errors['images'])): ?>
                  <div class="text-danger small"><?= htmlspecialchars($errors['images']) ?></div>
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-success w-100">Ajouter</button>
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


<br>


<?php 
require_once '../config/config_unv.php';

// Vérifier si un ID d'animal est passé
if (!isset($_GET['id'])) {
    die("ID d'animal manquant");
}

$id = $_GET['id'];

// Récupérer les données de l'animal
$sql = "SELECT * FROM animaux WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    die("Animal non trouvé.");
}

// Récupérer les habitats pour le menu déroulant
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$prenom = $animal['prenom'];
$race = $animal['race'];
$habitat_id = $animal['habitat_id'];
$imagesArray = json_decode($animal['images'], true) ?: [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation
    $prenom = trim($_POST['prenom']) ?: $errors['prenom'] = "Le prénom est requis.";
    $race = trim($_POST['race']) ?: $errors['race'] = "La race est requise.";
    $habitat_id = $_POST['habitat_id'] ?? '';
    
    // Gestion des images
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = '../assets/images/';
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($tmpName, $filePath)) {
                $imagesArray[] = $fileName;
            } else {
                $errors['images'] = "Erreur lors de l'upload de l'image.";
            }
        }
    }

    // Mise à jour dans la base de données
    if (empty($errors)) {
        $sql = "UPDATE animaux SET prenom = :prenom, race = :race, images = :images, habitat_id = :habitat_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':prenom' => $prenom,
            ':race' => $race,
            ':images' => json_encode($imagesArray),
            ':habitat_id' => $habitat_id,
            ':id' => $id
        ])) {
            header("Location: index.php");
            exit;
        } else {
            $errors['general'] = "Erreur lors de la mise à jour.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un Animal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-warning text-white">
            <h3 class="card-title mb-0 text-center">Modifier un Animal</h3>
          </div>
          <div class="card-body">
            <?php if (!empty($errors['general'])): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
            <?php endif; ?>
            <form action="modifier_animal.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
              
              <div class="mb-3">
                <label class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($prenom) ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Race :</label>
                <input type="text" name="race" class="form-control" value="<?= htmlspecialchars($race) ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Habitat :</label>
                <select name="habitat_id" class="form-select">
                  <?php foreach ($habitats as $habitat): ?>
                    <option value="<?= $habitat['id'] ?>" <?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
                      <?= htmlspecialchars($habitat['nom']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Images actuelles :</label>
                <div>
                  <?php foreach ($imagesArray as $image): ?>
                    <img src="../assets/images/<?= htmlspecialchars($image) ?>" width="100" class="me-2 mb-2">
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Nouvelle(s) image(s) :</label>
                <input type="file" name="images[]" class="form-control" multiple>
              </div>
              <button type="submit" class="btn btn-warning w-100">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
