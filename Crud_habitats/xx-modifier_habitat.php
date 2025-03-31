<?php
include '../config/database.php';

// Supposons que l'ID de l'habitat à modifier soit passé en paramètre GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Récupérer les données actuelles de l'habitat
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $description = $_POST["description"];

        // Initialiser le tableau pour les nouvelles images
        $newImagesArray = [];

        // Traitement des fichiers uploadés
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['name'] as $key => $name) {
                if (!empty($name)) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $destination = '../assets/uploads/' . basename($name);
                    if (move_uploaded_file($tmpName, $destination)) {
                        $newImagesArray[] = basename($name);
                    } else {
                        echo "<!-- Erreur lors du déplacement du fichier : $name -->\n";
                    }
                }
            }
        }

        // Décoder les images existantes
        $existingImages = json_decode($habitat['images'], true);
        if (!is_array($existingImages)) {
            $existingImages = [];
        }

        // Option 1 : Remplacer totalement les images par les nouvelles images
        // $finalImagesArray = $newImagesArray;

        // Option 2 : Fusionner les images existantes avec les nouvelles images
        $finalImagesArray = array_merge($existingImages, $newImagesArray);

        $imagesJson = json_encode($finalImagesArray);

        // Mettre à jour l'habitat dans la base de données
        $stmtUpdate = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
        if ($stmtUpdate->execute([$nom, $imagesJson, $description, $id])) {
            echo "Habitat modifié avec succès !";
        } else {
            echo "Erreur lors de la modification.";
        }
        
        // Optionnel : recharger les données mises à jour
        $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
        $stmt->execute([$id]);
        $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} else {
    echo "Habitat non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Habitat</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Vos styles ici (similaires à ceux du formulaire d'ajout) */
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 500px; width: 100%; }
    h2 { text-align: center; }
    label { font-weight: bold; display: block; margin-top: 10px; }
    input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
    .image-preview { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
    .image-preview img { max-width: 100px; border-radius: 5px; border: 1px solid #ddd; }
    .btn { background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; margin-top: 10px; }
    .btn:hover { background-color: #218838; }
  </style>
</head>
<body>
  <div class="container">
    <h2><i class="fas fa-edit"></i> Modifier l'Habitat</h2>
    <form method="post" enctype="multipart/form-data">
      <label>Nom de l'habitat :</label>
      <input type="text" name="nom" value="<?php echo htmlspecialchars($habitat['nom']); ?>" required>

      <label>Ajouter des Images :</label>
      <input type="file" name="images[]" id="images" accept="image/*" multiple>
      <div class="image-preview" id="image-preview">
        <!-- Affichage des images existantes -->
        <?php
          $existingImages = json_decode($habitat['images'], true);
          if (is_array($existingImages)) {
              foreach ($existingImages as $img) {
                  if (!empty($img)) {
                      echo '<img src="../assets/uploads/' . htmlspecialchars($img) . '" alt="Habitat Image">';
                  }
              }
          }
        ?>
      </div>

      <label>Description :</label>
      <textarea name="description" required><?php echo htmlspecialchars($habitat['description']); ?></textarea>

      <button type="submit" class="btn"><i class="fas fa-save"></i> Modifier Habitat</button>
    </form>
  </div>
  
  <script>
  // Script pour la prévisualisation des images ajoutées
  document.getElementById('images').addEventListener('change', function(event) {
      const previewContainer = document.getElementById('image-preview');
      // Vous pouvez choisir de vider l'aperçu ou de l'ajouter après les images existantes
      // previewContainer.innerHTML = '';
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