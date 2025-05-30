<?php
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

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
  //--------------------------------------------------------------------


  // Traitement des fichiers uploadés
  $imagesArray = [];
  if (isset($_FILES['images'])) {
    // Débogage : afficher la structure de $_FILES (visible dans le code source HTML)
    // echo "<!-- Débogage : "; var_dump($_FILES['images']); echo " -->\n";

    foreach ($_FILES['images']['name'] as $key => $name) {
      if (!empty($name)) {
        $tmpName = $_FILES['images']['tmp_name'][$key];
        // Préciser le chemin de destination avec le slash nécessaire
        $destination = '../assets/images/' . basename($name);
        // Déplacer le fichier uploadé vers le répertoire de destination
        if (move_uploaded_file($tmpName, $destination)) {
          // Ajouter le nom de l'image au tableau
          $imagesArray[] = basename($name);
          // Débogage : message de succès
          // echo "<!-- Fichier déplacé avec succès : $name -->\n";
        } else {
          // Débogage : message d'erreur
          echo "<!-- Erreur lors du déplacement du fichier : $name -->\n";
        }
      } else {
        // Débogage : nom de fichier vide
        echo "<!-- Nom de fichier vide détecté -->\n";
      }
    }
  }

  // Encodage du tableau d'images en JSON
  $imagesJson = json_encode($imagesArray);

  // Préparation et exécution de la requête d'insertion
  $stmt = $pdo->prepare("INSERT INTO animaux (prenom, race, images, habitat_id) VALUES (?, ?, ?, ?)");
  if ($stmt->execute([$prenom, $race, $imagesJson, $habitat_id])) {
    echo "Animal ajouté avec succès !";
  } else {
    echo "Erreur lors de l'ajout.";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Habitat</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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


    .image-preview {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
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
  </style>
</head>

<body>
  <div class="container">
    <h2><i class="fas fa-home"></i> Ajouter un Animal</h2>
    <!-- Le formulaire d'ajout d'habitat -->
    <form method="post" enctype="multipart/form-data">
      <label>Prenom de l'animal :</label>
      <input type="text" name="nom" required>

      <label>Espèce :</label><!-- Race -->
      <input type="text" name="race" required><br>

      <label>Images :</label>
      <input type="file" name="images[]" id="images" accept="image/*" multiple required>
      <div class="image-preview" id="image-preview"></div>

      <!--<label>Description :</label>
            <textarea name="description" required></textarea>-->

      <label class="form-label">Habitat :</label>
      <select name="habitat_id" class="form-select" required>
        <option value="">-- Sélectionner un habitat --</option>
        <?php foreach ($habitats as $habitat): ?>
          <option value="<?= $habitat['id'] ?>" <?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
            <?= htmlspecialchars($habitat['nom']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit" class="btn"><i class="fas fa-plus-circle"></i> Ajouter Habitat</button>

    </form>
  </div>

  <!-- Script JavaScript pour la prévisualisation des images -->
  <script>
    document.getElementById('images').addEventListener('change', function(event) {
      const previewContainer = document.getElementById('image-preview');
      previewContainer.innerHTML = '';

      const files = event.target.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            previewContainer.appendChild(imgElement);
          }
          reader.readAsDataURL(file);
        }
      }
    });
  </script>
</body>

</html>












<?php
// Connexion à la base de données
require_once '../config/config_unv.php'; // fichier contenant les infos PDO ($pdo)

// === Requête simple : Récupérer les habitats pour alimenter le menu déroulant ===
$sql = "SELECT id, nom FROM habitats";
$stmt = $pdo->query($sql); // Requête directe (non préparée car pas de données utilisateur)
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC); // Résultat sous forme de tableau associatif

// Initialisation des variables
$prenom = $race = $habitat_id = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // === Validation des champs ===
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

  // === Traitement des fichiers uploadés ===
  $imagesArray = [];
  if (isset($_FILES['images'])) {
    foreach ($_FILES['images']['name'] as $key => $name) {
      if (!empty($name)) {
        $tmpName = $_FILES['images']['tmp_name'][$key];
        $destination = '../assets/images/' . basename($name);
        if (move_uploaded_file($tmpName, $destination)) {
          $imagesArray[] = basename($name); // On stocke uniquement le nom de fichier
        } else {
          echo "<!-- Erreur lors du déplacement du fichier : $name -->\n";
        }
      } else {
        echo "<!-- Nom de fichier vide détecté -->\n";
      }
    }
  }

  // Conversion des noms d’images en JSON pour la base
  $imagesJson = json_encode($imagesArray);

  // === Requête préparée : insertion de l’animal dans la base ===
  $stmt = $pdo->prepare("
    INSERT INTO animaux (prenom, race, images, habitat_id) 
    VALUES (?, ?, ?, ?)
  ");
  if ($stmt->execute([$prenom, $race, $imagesJson, $habitat_id])) {
    echo "Animal ajouté avec succès !";
  } else {
    echo "Erreur lors de l'ajout.";
  }
}
?>


<!-- Début de la page HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Habitat</title>

  <!-- Import des icônes Font Awesome pour les décorations (ex : icône "maison", "plus", etc.) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div class="container">
    <h2><i class="fas fa-home"></i> Ajouter un Animal</h2>

    <!-- Formulaire d’ajout d’un animal -->
    <form method="post" enctype="multipart/form-data">
      <!-- Champ de saisie pour le prénom de l’animal -->
      <label>Prenom de l'animal :</label>
      <input type="text" name="nom" required>

      <!-- Champ de saisie pour la race / espèce de l’animal -->
      <label>Espèce :</label> <!-- Race -->
      <input type="text" name="race" required><br>

      <!-- Champ pour le téléversement (upload) de plusieurs images -->
      <label>Images :</label>
      <input type="file" name="images[]" id="images" accept="image/*" multiple required>

      <!-- Conteneur pour afficher les miniatures (preview) des images sélectionnées -->
      <div class="image-preview" id="image-preview"></div>

      <!-- Champ de sélection de l’habitat associé à l’animal -->
      <label class="form-label">Habitat :</label>
      <select name="habitat_id" class="form-select" required>
        <option value="">-- Sélectionner un habitat --</option>
        <!-- Remplissage dynamique du menu déroulant avec les habitats depuis PHP -->
        <?php foreach ($habitats as $habitat): ?>
          <option value="<?= $habitat['id'] ?>" <?= $habitat['id'] == $habitat_id ? 'selected' : '' ?>>
            <?= htmlspecialchars($habitat['nom']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Bouton pour envoyer le formulaire -->
      <button type="submit" class="btn"><i class="fas fa-plus-circle"></i> Ajouter Habitat</button>
    </form>
  </div>

<!-- Script JavaScript pour prévisualiser les images sélectionnées -->
<script>
    document.getElementById('images').addEventListener('change', function(event) {
      const previewContainer = document.getElementById('image-preview');
      previewContainer.innerHTML = ''; // On vide l’aperçu précédent

      const files = event.target.files; // On récupère les fichiers choisis
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file && file.type.startsWith('image/')) { // On vérifie que c’est bien une image
          const reader = new FileReader();
          reader.onload = function(e) {
            // Création d’une balise <img> pour afficher l’aperçu
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result; // On injecte la miniature
            previewContainer.appendChild(imgElement); // On l’ajoute au DOM
          }
          reader.readAsDataURL(file); // On lit le contenu de l’image
        }
      }
    });
  </script>
</body>

</html>

