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
  $prenom = $_POST["prenom"] ?? "";
  $race = $_POST["race"] ?? "";
  $habitat_id = $_POST["habitat_id"] ?? "";

  // Gestion de l'image
  if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') {
    $tmpName = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $destination = '../assets/images/' . $fileName;

    if (move_uploaded_file($tmpName, $destination)) {
      $imagesArray[0] = $fileName; // Mettre à jour la première image
    }
  }

  $imagesJson = json_encode([$imagesArray[0]]);

  // Mettre à jour l'animal
  $stmt = $pdo->prepare("UPDATE animaux SET prenom = ?, race = ?, habitat_id = ?, images = ? WHERE id = ?");
  if ($stmt->execute([$prenom, $race, $habitat_id, $imagesJson, $id])) {
    echo "<p style='color:green;'>Animal modifié avec succès !</p>";
  } else {
    echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Animal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
    }

    h2 {
      text-align: center;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .image-preview img {
      max-width: 100px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    .btn {
      background-color: #28a745;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #218838;
    }


    /* Aperçu des images */
    #imagePreview {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }

    #imagePreview img {
      max-width: 100px;
      /*150px*/
      border: 1px solid #ddd;
      border-radius: 5px;
    }
  </style>

  <script>
    function previewImages(event) {
      const previewContainer = document.getElementById('imagePreview'); //imagePreview
      previewContainer.innerHTML = ''; // Efface les aperçus existants
      const files = event.target.files;
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    }
  </script>

</head>

<body>

  <div class="container">
    <h2>Modifier un Animal</h2>
    <form method="post" enctype="multipart/form-data">

      <div class="image-preview">
        <?php if (!empty($imagesArray[0])): ?>
          <img src="../assets/images/<?= htmlspecialchars($imagesArray[0]); ?>" alt="Image de l'animal">
        <?php else: ?>
          <p>Aucune image disponible.</p>
        <?php endif; ?>
      </div>

      <label>Nom de l'animal :</label>
      <input type="text" name="prenom" value="<?= htmlspecialchars($prenom); ?>" required>

      <label>Race :</label>
      <input type="text" name="race" value="<?= htmlspecialchars($race); ?>" required>


      <label for="image">Nouvelle image :</label>
      <input type="file" id="images" name="image" accept="image/*" onchange="previewImages(event)">
      <div id="imagePreview"></div>

      <!--<label for="images">Images (vous pouvez charger plusieurs fichiers) :</label>
      <input type="file" id="images" name="images[]" multiple accept="image/*" onchange="previewImages(event)">
      <div id="imagePreview"></div>-->

      <label>Habitat :</label>
      <select name="habitat_id" required>
        <option value="">-- Sélectionner un habitat --</option>
        <?php foreach ($habitats as $habitat): ?>
          <option value="<?= $habitat['id'] ?>" <?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
            <?= htmlspecialchars($habitat['nom']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit" class="btn">Modifier l'Animal</button>
    </form>
  </div>

</body>

</html>