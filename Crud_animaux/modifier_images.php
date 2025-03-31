<?php 
// animaux/modifier.php
//require_once '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Récupérer les habitats pour le menu déroulant
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

// Vérifier si l'ID de l'animal est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $animalId = intval($_GET['id']);

    // Récupérer les informations de l'animal
    $sql = "SELECT * FROM animaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        $prenom = $animal['prenom'];
        $race = $animal['race'];
        $habitat_id = $animal['habitat_id'];
        $imagesArray = json_decode($animal['images'], true);

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

            if (empty($errors)) {
                // Mise à jour dans la base de données
                $sql = "UPDATE animaux SET prenom = :prenom, race = :race, images = :images, habitat_id = :habitat_id WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([
                    ':prenom' => $prenom,
                    ':race' => $race,
                    ':images' => json_encode($imagesArray),
                    ':habitat_id' => $habitat_id,
                    ':id' => $animalId
                ])) {
                    header("Location: index.php");
                    exit;
                } else {
                    $errors['general'] = "Une erreur est survenue lors de la mise à jour.";
                }
            }
        }
    } else {
        $errors['general'] = "Animal non trouvé.";
    }
} else {
    $errors['general'] = "ID invalide.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Animal</title>
  <!-- Bootstrap CSS --> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .error {
      color: red;
      font-size: 0.9rem;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      align-content: center;
    }

    /*@media (max-width: 576px){
      .card-body {
       width: 100%;       
      }
    }*/

  </style>
</head>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4">Modifier un Animal</h1>
    <?php if (!empty($errors['general'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="modifier.php?id=<?= $animalId ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($prenom) ?>">
            <?php if (!empty($errors['prenom'])): ?>
              <div class="text-danger small"><?= htmlspecialchars($errors['prenom']) ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="race" class="form-label">Race :</label>
            <input type="text" name="race" id="race" class="form-control" value="<?= htmlspecialchars($race) ?>">
            <?php if (!empty($errors['race'])): ?>
              <div class="text-danger small"><?= htmlspecialchars($errors['race']) ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="habitat_id" class="form-label">Habitat :</label>
            <select name="habitat_id" id="habitat_id" class="form-select">
              <option value="">--Sélectionner un habitat--</option>
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
          <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS Bundle -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>







<!--?php
// animaux/modifier.php
//require_once '../includes/config.php';
require_once '../config/database.php';

// Récupérer les habitats pour le menu déroulant
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

// Vérifier si l'ID de l'animal est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $animalId = intval($_GET['id']);

    // Récupérer les informations de l'animal
    $sql = "SELECT * FROM animaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        $prenom = $animal['prenom'];
        $race = $animal['race'];
        $habitat_id = $animal['habitat_id'];
        $imagesArray = json_decode($animal['images'], true);

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

            if (empty($errors)) {
                // Mise à jour dans la base de données
                $sql = "UPDATE animaux SET prenom = :prenom, race = :race, images = :images, habitat_id = :habitat_id WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([
                    ':prenom' => $prenom,
                    ':race' => $race,
                    ':images' => json_encode($imagesArray),
                    ':habitat_id' => $habitat_id,
                    ':id' => $animalId
                ])) {
                    // Redirection après succès
                    header("Location: index.php");
                    exit;
                } else {
                    $errors['general'] = "Une erreur est survenue lors de la mise à jour.";
                }
            }
        }
    } else {
        $errors['general'] = "Animal non trouvé.";
    }
} else {
    $errors['general'] = "ID invalide.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Animal</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Modifier un Animal</h1>
    <!?php if (!empty($errors['general'])): ?>
        <p class="error"><!?= htmlspecialchars($errors['general']) ?></p>
    <!?php endif; ?>
    <form action="modifier.php?id=<!?= $animalId ?>" method="post" enctype="multipart/form-data">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<!?= htmlspecialchars($prenom) ?>">
        <!?php if (!empty($errors['prenom'])): ?>
            <p class="error"><!?= htmlspecialchars($errors['prenom']) ?></p>
        <!?php endif; ?>

        <label for="race">Race :</label>
        <input type="text" name="race" id="race" value="<!?= htmlspecialchars($race) ?>">
        <!?php if (!empty($errors['race'])): ?>
            <p class="error"><!?= htmlspecialchars($errors['race']) ?></p>
        <!?php endif; ?>

        <label for="habitat_id">Habitat :</label>
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

        <label for="images">Images :</label>
        <input type="file" name="images[]" id="images" multiple>
        <!?php if (!empty($errors['images'])): ?>
            <p class="error"><!?= htmlspecialchars($errors['images']) ?></p>
        <!?php endif; ?>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>


















<!--?php
// animaux/modifier.php
require_once '../includes/config.php';

// Récupérer les habitats pour le menu déroulant
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

// Vérifier si l'ID de l'animal est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $animalId = intval($_GET['id']);

    // Récupérer les informations de l'animal
    $sql = "SELECT * FROM animaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        $prenom = $animal['prenom'];
        $race = $animal['race'];
        $habitat_id = $animal['habitat_id'];
        $imagesArray = json_decode($animal['images'], true);

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

            if (empty($errors)) {
                // Mise à jour dans la base de données
                $sql = "UPDATE animaux SET prenom = :prenom, race = :race, images = :images, habitat_id = :habitat_id WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([
                    ':prenom' => $prenom,
                    ':race' => $race,
                    ':images' => json_encode($imagesArray),
                    ':habitat_id' => $habitat_id,
                    ':id' => $animalId
                ])) {
                    // Redirection après succès
                    header("Location: index.php");
                    exit;
                } else {
                    $errors['general'] = "Une erreur est survenue lors de la mise à jour.";
                }
            }
        }
    } else {
        $errors['general'] = "Animal non trouvé.";
    }
} else {
    $errors['general'] = "ID invalide.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta
::contentReference[oaicite:0]{index=0}

                -->
