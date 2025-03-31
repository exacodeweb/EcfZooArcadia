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
        $sql = "INSERT INTO animaux (prenom, race, images, habitat_id) VALUES (:prenom, :race, :images, :habitat_id)";
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
  <title>Ajouter un Animal</title>
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





<!--?php
// animaux/ajouter.php
require_once '../config/database.php';

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
        $sql = "INSERT INTO animaux (prenom, race, images, habitat_id) VALUES (:prenom, :race, :images, :habitat_id)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':prenom' => $prenom,
            ':race' => $race,
            ':images' => json_encode($imagesArray),
            ':habitat_id' => $habitat_id
        ])) {
            // Redirection après succès
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
  <title>Ajouter un Animal</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <h1>Ajouter un Animal</h1>
  <!?php if (!empty($errors['general'])): ?>
      <p class="error"><!?= htmlspecialchars($errors['general']) ?></p>
  <!?php endif; ?>
  <form action="ajouter.php" method="post" enctype="multipart/form-data">
      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom" id="prenom" value="<!?= htmlspecialchars($prenom) ?>">
      <!?php if (!empty($errors['prenom'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['prenom']) ?></p>
      <!?php endif; ?>

      <label for="race">Race :</label>
      <input type="text" name="race" id="race" value="<!?= htmlspecialchars($race) ?>">
      <!?php if (!empty($errors['race'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['race']) ?></p>
      <!?php endif; ?>

      <label for="habitat_id">Habitat :</label>
      <select name="habitat_id" id="habitat_id">
          <option value="">--Sélectionner un habitat--</option>
          <!?php foreach ($habitats as $habitat): ?>
              <option value="<!?= $habitat['id'] ?>" <!?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
                  <!?= htmlspecialchars($habitat['nom']) ?>
              </option>
          <!?php endforeach; ?>
      </select>
      <!?php if (!empty($errors['habitat_id'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['habitat_id']) ?></p>
      <!?php endif; ?>

      <label for="images">Images :</label>
      <input type="file" name="images[]" id="images" multiple>
      <!?php if (!empty($errors['images'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['images']) ?></p>
      <!?php endif; ?>

      <button type="submit">Ajouter</button>
  </form>
</body>
</html>

      -->



<!--?php
// animaux/ajouter.php
//require_once '../includes/config.php';
require_once '../config/database.php';

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

  }

// Insertion dans la base de données
if (empty($errors)) {
  $sql = "INSERT INTO animaux (prenom, race, images, habitat_id) VALUES (:prenom, :race, :images, :habitat_id)";
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute([
      ':prenom' => $prenom,
      ':race' => $race,
      ':images' => json_encode($imagesArray),
      ':habitat_id' => $habitat_id
  ])) {
      // Redirection après succès
      header("Location: index.php");
      exit;
  } else {
      $errors['general'] = "Une erreur est survenue lors de l'ajout.";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un Animal</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <h1>Ajouter un Animal</h1>
  <!?php if (!empty($errors['general'])): ?>
      <p class="error"><!?= htmlspecialchars($errors['general']) ?></p>
  <!?php endif; ?>
  <form action="ajouter.php" method="post" enctype="multipart/form-data">
      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom" id="prenom" value="<!?= htmlspecialchars($prenom) ?>">
      <!!?php if (!empty($errors['prenom'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['prenom']) ?></p>
      <!?php endif; ?>

      <label for="race">Race :</label>
      <input type="text" name="race" id="race" value="<!?= htmlspecialchars($race) ?>">
      <!?php if (!empty($errors['race'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['race']) ?></p>
      <!?php endif; ?>

      <label for="habitat_id">Habitat :</label>
      <select name="habitat_id" id="habitat_id">
          <option value="">--Sélectionner un habitat--</option>
          <!?php foreach ($habitats as $habitat): ?>
              <option value="<!?= $habitat['id'] ?>" <!?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
                  <!?= htmlspecialchars($habitat['nom']) ?>
              </option>
          <!?php endforeach; ?>
      </select>
      <!?php if (!empty($errors['habitat_id'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['habitat_id']) ?></p>
      <!?php endif; ?>

      <label for="images">Images :</label>
      <input type="file" name="images[]" id="images" multiple>
      <!?php if (!empty($errors['images'])): ?>
          <p class="error"><!?= htmlspecialchars($errors['images']) ?></p>
      <!?php endif; ?>

      <button type="submit">Ajouter</button>
  </form>
</body>
</html>
