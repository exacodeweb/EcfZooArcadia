<?php 
require_once '../config/config_unv.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        echo "Service non trouvé.";
        exit;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $description = $_POST["description"];
        
        $imagesArray = json_decode($service['images'], true); 
        
        if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') {
            $tmpName = $_FILES['image']['tmp_name'];
            $destination = '../assets/services/' . basename($_FILES['image']['name']);
            
            if (move_uploaded_file($tmpName, $destination)) {
                $imagesArray[0] = basename($_FILES['image']['name']); 
            }
        }
        
        $imagesJson = json_encode([$imagesArray[0]]); 

        $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$nom, $imagesJson, $description, $id])) {
            echo "Service modifié avec succès !";
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
} else {
    echo "ID du service non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Service</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 500px; width: 100%; }
        h2 { text-align: center; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .image-preview img { max-width: 100px; border-radius: 5px; border: 1px solid #ddd; }
        .btn { background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; margin-top: 10px; }
        .btn:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Modifier un Service</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nom du service :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($service['nom']); ?>" required>
        
        <label>Image principale :</label>
        <input type="file" name="image" accept="image/*">
        <div class="image-preview">
            <img src="../assets/services/<?= htmlspecialchars(json_decode($service['images'])[0] ?? ''); ?>" alt="Image" />
        </div>
        
        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($service['description']); ?></textarea>
        
        <button type="submit" class="btn">Modifier Service</button>
    </form>
</div>
</body>
</html>























<!--?php
require_once '../config/config_unv.php';

// Vérifier si l'ID du service à modifier est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données du service depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        echo "Service non trouvé.";
        exit;
    }

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $description = $_POST["description"];
        
        // Traitement des fichiers uploadés
        $imagesArray = json_decode($service['images'], true); // Récupérer les anciennes images
        $imagesArrayOriginal = $imagesArray;  // Conserver les images d'origine

        // Si de nouvelles images sont téléchargées
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['name'] as $key => $name) {
                if (!empty($name)) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $destination = '../assets/services/' . basename($name);

                    // Si une nouvelle image est ajoutée, remplacez l'image principale
                    if (empty($imagesArray)) {
                        if (move_uploaded_file($tmpName, $destination)) {
                            $imagesArray = [basename($name)]; // Remplace l'ancienne image
                        }
                    } else {
                        // Sinon, ajouter les nouvelles images aux images existantes
                        if (move_uploaded_file($tmpName, $destination)) {
                            $imagesArray[] = basename($name);
                        }
                    }
                }
            }
        }

        // Encodage du tableau d'images en JSON
        $imagesJson = json_encode($imagesArray);

        // Mise à jour des données dans la base
        $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$nom, $imagesJson, $description, $id])) {
            echo "Service modifié avec succès !";
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
} else {
    echo "ID du service non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Service</title>
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
        input, textarea {
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
    <h2><i class="fas fa-home"></i> Modifier un Service</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nom du service :</label>
        <input type="text" name="nom" value="<-?= htmlspecialchars($service['nom']); ?>" required>

        <label>Images :</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple>
        <div class="image-preview" id="image-preview">
            <-?php
            $imagesArray = json_decode($service['images'], true);
            foreach ($imagesArray as $image) {
                echo '<img src="../assets/services/' . htmlspecialchars($image) . '" alt="Image" />';
            }
            ?>
        </div>

        <label>Description :</label>
        <textarea name="description" required><-?= htmlspecialchars($service['description']); ?></textarea>

        <button type="submit" class="btn"><i class="fas fa-edit"></i> Modifier Service</button>
    </form>
</div>

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

---------------->






<!--?php
require_once '../config/config_unv.php';

// Vérifier si l'ID du service à modifier est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données du service depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        echo "Service non trouvé.";
        exit;
    }

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $description = $_POST["description"];
        
        // Traitement des fichiers uploadés
        $imagesArray = json_decode($service['images'], true); // Récupérer les anciennes images

        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['name'] as $key => $name) {
                if (!empty($name)) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $destination = '../assets/services/' . basename($name);

                    if (move_uploaded_file($tmpName, $destination)) {
                        $imagesArray[] = basename($name); // Ajouter l'image au tableau
                    } else {
                        echo " -----------><!-- Erreur lors du déplacement du fichier : $name --><!------------\n";
                    }
                }
            }
        }

        // Encodage du tableau d'images en JSON
        $imagesJson = json_encode($imagesArray);

        // Mise à jour des données dans la base
        $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$nom, $imagesJson, $description, $id])) {
            echo "Service modifié avec succès !";
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
} else {
    echo "ID du service non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Service</title>
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
        input, textarea {
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
    <h2><i class="fas fa-home"></i> Modifier un Service</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nom du service :</label>
        <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']); ?>" required>

        <label>Images :</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple>
        <div class="image-preview" id="image-preview">
            <!?php
            $imagesArray = json_decode($service['images'], true);
            foreach ($imagesArray as $image) {
                echo '<img src="../assets/services/' . htmlspecialchars($image) . '" alt="Image" />';
            }
            ?>
        </div>

        <label>Description :</label>
        <textarea name="description" required><!?= htmlspecialchars($service['description']); ?></textarea>

        <button type="submit" class="btn"><i class="fas fa-edit"></i> Modifier Service</button>
    </form>
</div>

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
-------------------->


<!--?php
require_once '../config/config_unv.php';

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
  $stmt->execute([$id]);
  $service = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifie si "images" est vide ou null et initialise un tableau vide
  $service["images"] = !empty($service["images"]) ? json_decode($service["images"], true) : [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = $_POST["nom"];
  $description = $_POST["description"];

  // Traiter les images sans valeurs vides
  $imagesArray = isset($_POST["images"]) ? explode(',', $_POST["images"]) : [];
  $imagesArray = array_filter($imagesArray, fn($value) => !empty(trim($value))); // Supprime les valeurs vides
  $images = json_encode(array_values($imagesArray)); // Réindexe et encode proprement

  $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
  if ($stmt->execute([$nom, $images, $description, $id])) {
    echo "<p class='success'>Service modifié avec succès !</p>";
  } else {
    echo "<p class='error'>Erreur lors de la modification.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Service</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <script src="./ajax-1.php" defer></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
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
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      width: 100%;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      font-weight: bold;
      display: block;
      margin: 10px 0 5px;
    }

    input,
    textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    .image-preview {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 10px;
    }

    .image-preview img {
      width: 70px;
      height: 70px;
      border-radius: 5px;
      border: 1px solid #ddd;
      object-fit: cover;
    }

    button {
      width: 100%;
      background: #28a745;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover {
      background: #218838;
    }

    .success {
      color: green;
      text-align: center;
      margin-top: 10px;
    }

    .alert {
      color: orange;
      text-align: center;
      margin-top: 10px;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>


</head>

<body>
  <div class="container">
    <h2><i class="fas fa-edit"></i> Modifier un Service</h2>

    <form method="post">
      <label>Nom du service:</label>
      <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']) ?>" required>

      <label>Images :</label>

      <input type="hidden" name="images" id="image-input">
      <input type="file" id="file-selector" accept="image/*" style="display: none;">

      <button type="button" id="choose-image"><i class="fas fa-upload"></i> Choisir une image</button>

      <div class="image-preview" id="preview-container">
        <!?php
        if (!empty($service["images"]) && is_array($service["images"])) {
          foreach ($service["images"] as $image) {
            if (!empty($image)) {
              echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu'>";
            }
          }
        } else {
          echo "<p class='alert'>Aucune image sélectionnée !</p>";
        }
        ?>
      </div>  ------------------------>

      <!--<div class="image-preview" id="preview-container">
        <!?php
        $images = json_decode($service["images"], true);
        if (!empty($images) && is_array($images)) {
          foreach ($images as $image) {
            echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu' style='width: 70px; height: 70px;'>";
          }
        } else {
          echo "<p>Aucune image sélectionnée</p>";
        }
        ?> 
      </div>-->  <!--------------------------

      <label>Description :</label>
      <textarea name="description" required><!?= htmlspecialchars($service['description']) ?></textarea>
      <button type="submit"><i class="fas fa-save"></i> Modifier</button>
    </form>
-->




    
    <!-----------------------------------------------------------------------------------------------------------------><!--
    <form id="updateForm" enctype="multipart/form-data">
      <label for="name">Nom du service :</label>
      <input type="text" id="name" name="name" value="<!?= htmlspecialchars($service['nom'] ?? '') ?>">

      <label for="description">Description :</label>
      <textarea id="description" name="description"><!?= htmlspecialchars($service['description'] ?? '') ?></textarea>

      <div id="preview-container">
        <img src="assets/services/<!?= htmlspecialchars($service['image'] ?? '') ?>" alt="Aperçu" style="max-width: 200px;">
      </div>

      <label for="file-selector">Changer l'image :</label>
      <input type="file" id="file-selector" name="image">

      <button type="submit">Modifier</button>
    </form>

    <div id="message"></div> -->
    <!----------------------------------------------------------------------------------------------------------------->

<!--
  </div>

  <script>
    document.getElementById("choose-image").addEventListener("click", function() {
      document.getElementById("file-selector").click();
    });

    document.getElementById("file-selector").addEventListener("change", function(event) {
      let file = event.target.files[0];
      if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById("image-input").value = file.name;
          let previewContainer = document.getElementById("preview-container");
          previewContainer.innerHTML = `<img src="${e.target.result}" alt="Aperçu" style="width: 70px; height: 70px; border-radius: 5px; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
-->

  <!-- Ajouter jQuery si ce n'est pas déjà fait -->  <!--
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./ajax.js"></script>

</body>

</html>
-->







<!--?php
require_once '../config/config_unv.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!isset($service["images"]) || empty($service["images"])) {
        $service["images"] = json_encode([]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_decode($service['images'], true);

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $uploadDir = '../assets/services/';
        $imageName = basename($_FILES["image"]["name"]);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
            $images[] = $imageName;
        } else {
            echo "<p class='error'>Erreur lors de l'upload de l'image.</p>";
        }
    }

    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, json_encode($images), $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-edit"></i> Modifier un Service</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Nom :</label>
            <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']) ?>" required>
            
            <label>Images :</label>
            <input type="file" name="image" id="file-selector" accept="image/*">
            <div class="image-preview" id="preview-container">
                <!?php 
                $images = json_decode($service["images"], true);
                if (!empty($images) && is_array($images)) {
                    foreach ($images as $image) {
                        echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu' width='70' height='70'>";
                    }
                } else {
                    echo "<p>Aucune image sélectionnée</p>";
                }
                ?>
            </div>
            
            <label>Description :</label>
            <textarea name="description" required><!?= htmlspecialchars($service['description']) ?></textarea>
            
            <button type="submit"><i class="fas fa-save"></i> Modifier</button>
        </form>
    </div>
    
    <script>
    document.getElementById("file-selector").addEventListener("change", function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let previewContainer = document.getElementById("preview-container");
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Aperçu" width="70" height="70">`;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>-->




























<!-- version test --><!------------------------------------------------------------------------------------------------>
<!--?php
//include '../config/database.php';
require_once '../config/config_unv.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Habitat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .image-preview img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            border: 1px solid #ddd;
            object-fit: cover;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-edit"></i> Modifier un Service</h2>
    
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']) ?>" required> -------------------->

<!---------------------------------------------------->
<!--<label>Images :</label>
        <input type="text" name="images" value="<!?= implode(',', json_decode($service['images'], true)) ?>" required>
        
        <div class="image-preview">
            <!?php 
            $images = json_decode($service["images"], true);
            foreach ($images as $image) {
                echo "<img src='../assets/services/$image'>";
            }
            ?>
        </div> -->
<!---------------------------------------------------->

        <!--<div class="image-preview">
            <!?php 
            $images = json_decode($service["images"], true);
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu de l'image'>";
                }
            } else {
                echo "<p>Aucune image disponible</p>";
            }
            ?>
        </div>  -->

<!----------------------------------------------------------------->   <!----------------------------
        <label>Images :</label>   ------------------->
<!--<input type="text" name="images" id="image-input" value="<!?= implode(',', json_decode($service['images'], true)) ?>" required readonly>-->
<!--<input type="file" id="file-selector" accept="image/*" style="display: none;">
        <button type="button" id="choose-image"><i class="fas fa-upload"></i> Choisir une image</button>-->
<!----------------------
        <div class="image-preview" id="preview-container">
            <!?php //L'écriture est de style itératif ?
            $images = json_decode($service["images"], true);
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu'>";
                }
            } else {
                echo "<p>Aucune image sélectionnée</p>";
            }
            ?>
        </div>      ------------------------->
<!----------------------------------------------------------------->  <!---------------------------

        <label>Description :</label>
        <textarea name="description" required><!?= htmlspecialchars($service['description']) ?></textarea>

        <button type="submit"><i class="fas fa-save"></i> Modifier</button>
    </form>
</div> -------------------------------->

<!--------------------------------------------------------> <!------------------------
<script>
document.getElementById("choose-image").addEventListener("click", function() {
    document.getElementById("file-selector").click();
});

document.getElementById("file-selector").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("image-input").value = file.name;
            let previewContainer = document.getElementById("preview-container");
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Aperçu" style="width: 70px; height: 70px; border-radius: 5px; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>  ----------------------->
<!-------------------------------------------------------->  <!-----------------------

</body>
</html>  ---------------------->
<!--------------------------------------------------------------------------------------------------------------------->








<!-- version de depart -->
<!--?php
//include 'config.php';
include '../config/database.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "Habitat modifié avec succès !";
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  


<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<!?= htmlspecialchars($habitat['nom']) ?>" required><br>

    <label>Images :</label>
    <input type="text" name="images" value="<!?= implode(',', json_decode($habitat['images'], true)) ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><!?= htmlspecialchars($habitat['description']) ?></textarea><br>

    <button type="submit">Modifier Habitat</button>
</form>

</body>
</html>


-->















































<!--?php
//include 'config.php';
include '../config/database.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "Habitat modifié avec succès !";
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<!?= htmlspecialchars($habitat['nom']) ?>" required><br>

    <label>Images :</label>
    <input type="text" name="images" value="<!?= implode(',', json_decode($habitat['images'], true)) ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><!?= htmlspecialchars($habitat['description']) ?></textarea><br>

    <button type="submit">Modifier Habitat</button>
</form>
</body>
</html>
          -->


















<!--?php
//include 'config.php';
include '../config/database.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "Habitat modifié avec succès !";
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
          -->

<!--<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>



  <style>-->
<!--?php
include '../config/database.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Habitat modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>-->

<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Habitat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>-->

<!--<div class="container">
    <h2><i class="fas fa-edit"></i> Modifier Habitat</h2>
    
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<!?= htmlspecialchars($habitat['nom']) ?>" required>

        <label>Images :</label>
        <input type="text" name="images" value="<!?= implode(',', json_decode($habitat['images'], true)) ?>" required>
        
        <div class="image-preview">
            <!?php 
            $images = json_decode($habitat["images"], true);
            foreach ($images as $image) {
                echo "<img src='../assets/images/$image'>";
            }
            ?>
        </div>

        <label>Description :</label>
        <textarea name="description" required><!?= htmlspecialchars($habitat['description']) ?></textarea>

        <button type="submit"><i class="fas fa-save"></i> Modifier</button>
    </form>
</div> -->

<!--</body>
</html>-->
<!------------------------------------------------------------------------------------------------------------------>



<!--</style>
</head>
<body>-->

<!--
<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<!?= htmlspecialchars($habitat['nom']) ?>" required><br>

    <label>Images :</label>
    <input type="text" name="images" value="<!?= implode(',', json_decode($habitat['images'], true)) ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><!?= htmlspecialchars($habitat['description']) ?></textarea><br>

    <button type="submit">Modifier Habitat</button>
</form>
</body>
</html>
          -->













<!--<style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .image-preview img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            border: 1px solid #ddd;
            object-fit: cover;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>-->




<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Habitats</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-size: 1rem;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: left;
        }
        td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }
        .img-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead {
                display: none;
            }
            tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
                padding: 10px;
                background: #f8f9fa;
            }
            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
            }
            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #007bff;
            }
            .btn {
                width: 100%;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Liste des Habitats</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Habitats</th>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($habitats as $habitat): ?>
                        <tr>
                            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
                            <td data-label="Images">
                                <!?php
                                $images = json_decode($habitat["images"], true);
                                foreach ($images as $image) {
                                    echo "<img src='../assets/images/$image' class='img-thumbnail'>";
                                }
                                ?>
                            </td>
                            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
                            <td data-label="Actions">
                                <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet habitat ?')">Supprimer</a>
                            </td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

                    -->




<!--?php 
include '../config/database.php';

$stmt = $pdo->query("SELECT * FROM habitats");
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Habitats</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* Base */
    body {
      font-size: 1rem;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 1rem;
    }
    h2 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }
    /* Tableau classique */
    .table-responsive {
      margin-top: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
      overflow: hidden;
    }
    th, td {
      padding: 1rem;
      text-align: center;
      vertical-align: middle;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #007bff;
      color: #fff;
      font-size: 1rem;
    }
    td {
      font-size: 0.9rem;
    }
    /* Images uniformisées */
    .table img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 0.5rem;
      margin: 0.25rem;
    }
    /* Boutons d'action */
    .actions a {
      text-decoration: none;
      padding: 0.5rem 1rem;/*taille des boutons*/
      margin: 0.25rem;
      border-radius: 0.5rem;
      color: #fff;
      font-weight: 600;
      display: inline-block;
      font-size: 0.9rem;
    }
    .actions a.btn-warning { background-color: #ffc107; }
    .actions a.btn-danger { background-color: #dc3545; }
    .actions a:hover { opacity: 0.8; }
    
    /* Responsive : Mode carte pour les petits écrans */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
      }
      td:last-child {
        border-bottom: 0;
      }
      /* Ajout du label avant le contenu, à partir de l'attribut data-label */
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        width: 40%;
        text-align: left;

        display: none;
      }
      /* Boutons en mode mobile, en pleine largeur avec un peu d'espacement */
      .actions a {
        width: 48%;
        margin: 0.25rem 1%;
      }
    }
  </style>
</head>
<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Habitats</h2>
  <div class="d-flex justify-content-end mb-3">
    <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Habitats</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!?php foreach ($habitats as $habitat): ?>
          <tr>
            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
            <td data-label="Images">
              <!?php
              $images = json_decode($habitat["images"], true);
              foreach ($images as $image) {
                echo "<img src='../assets/images/" . htmlspecialchars($image) . "' alt='Image'>";
              }
              ?>
            </td>
            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
            <td data-label="Actions" class="actions">
              <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" onclick="return confirm('Supprimer cet habitat ?')" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
          </tr>
        <!?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
        -->
<!----------------------------------------------------------------------->


























<!--?php 
include '../config/database.php';

$stmt = $pdo->query("SELECT * FROM habitats");
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Habitats</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* Base */
    body {
      font-size: 1rem;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 1rem;
    }
    h2 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }
    /* Tableau classique */
    .table-responsive {
      margin-top: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
      overflow: hidden;
    }
    th, td {
      padding: 1rem;
      text-align: center;
      vertical-align: middle;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #007bff;
      color: #fff;
      font-size: 1rem;
    }
    td {
      font-size: 0.9rem;
    }
    /* Images uniformisées */
    .table img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 0.5rem;
      margin: 0.25rem;
    }
    /* Boutons d'action */
    .actions a {
      text-decoration: none;
      padding: 0.5rem 1rem;/*taille des boutons*/
      margin: 0.25rem;
      border-radius: 0.5rem;
      color: #fff;
      font-weight: 600;
      display: inline-block;
      font-size: 0.9rem;
    }
    .actions a.btn-warning { background-color: #ffc107; }
    .actions a.btn-danger { background-color: #dc3545; }
    .actions a:hover { opacity: 0.8; }
    
    /* Responsive : Mode carte pour les petits écrans */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
      }
      td:last-child {
        border-bottom: 0;
      }
      /* Ajout du label avant le contenu, à partir de l'attribut data-label */
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        width: 40%;
        text-align: left;

        display: none;
      }
      /* Boutons en mode mobile, en pleine largeur avec un peu d'espacement */
      .actions a {
        width: 48%;
        margin: 0.25rem 1%;
      }
    }
  </style>
</head>
<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Habitats</h2>
  <div class="d-flex justify-content-end mb-3">
    <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Habitats</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!?php foreach ($habitats as $habitat): ?>
          <tr>
            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
            <td data-label="Images">
              <!?php
              $images = json_decode($habitat["images"], true);
              foreach ($images as $image) {
                echo "<img src='../assets/images/" . htmlspecialchars($image) . "' alt='Image'>";
              }
              ?>
            </td>
            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
            <td data-label="Actions" class="actions">
              <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" onclick="return confirm('Supprimer cet habitat ?')" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
          </tr>
        <!?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
        -->
<!--------------------------------------------------------------------------------------------------------------------->












<!--?php
include '../config/database.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Habitat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .image-preview img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            border: 1px solid #ddd;
            object-fit: cover;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-edit"></i> Modifier Habitat</h2>
    
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']) ?>" required>  -->

<!---------------------------------------------------->
<!--<label>Images :</label>
        <input type="text" name="images" value="<!?= implode(',', json_decode($service['images'], true)) ?>" required>
        
        <div class="image-preview">
            <!?php 
            $images = json_decode($service["images"], true);
            foreach ($images as $image) {
                echo "<img src='../assets/services/$image'>";
            }
            ?>
        </div> -->
<!---------------------------------------------------->

<!--<div class="image-preview">
            <!?php 
            $images = json_decode($service["images"], true);
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu de l'image'>";
                }
            } else {
                echo "<p>Aucune image disponible</p>";
            }
            ?>
        </div>-->

<!-----------------------------------------------------------------> <!-------------------
        <label>Images :</label> ------------------>
<!--<input type="text" name="images" id="image-input" value="<!?= implode(',', json_decode($service['images'], true)) ?>" required readonly>-->
<!-------------<input type="file" id="file-selector" accept="image/*" style="display: none;">
        <button type="button" id="choose-image"><i class="fas fa-upload"></i> Choisir une image</button>

        <div class="image-preview" id="preview-container">
            <!?php //L'écriture est de style itératif ?
            $images = json_decode($service["images"], true);
            if (!empty($images) && is_array($images)) {
                foreach ($images as $image) {
                    echo "<img src='../assets/services/" . htmlspecialchars($image) . "' alt='Aperçu'>";
                }
            } else {
                echo "<p>Aucune image sélectionnée</p>";
            }
            ?>
        </div>  ----------------------->
<!-----------------------------------------------------------------> <!-----------------------


        <label>Description :</label>
        <textarea name="description" required><!?= htmlspecialchars($service['description']) ?></textarea>

        <button type="submit"><i class="fas fa-save"></i> Modifier</button>
    </form>
</div> ------------------------>



<!--------------------------------------------------------> <!--------------------
<script>
document.getElementById("choose-image").addEventListener("click", function() {
    document.getElementById("file-selector").click();
});

document.getElementById("file-selector").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("image-input").value = file.name;
            let previewContainer = document.getElementById("preview-container");
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Aperçu" style="width: 70px; height: 70px; border-radius: 5px; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
    }
});
</script> ------------------------>
<!--------------------------------------------------------> <!------------------------

</body>
</html>
 ---------------------->






<!--
 <form id="updateForm" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<!?= $service['id'] ?>">
    
    <label for="nom">Nom du Service:</label>
    <input type="text" name="nom" value="<!?= htmlspecialchars($service['nom']) ?>" required>
    
    <!label for="description">Description:</!label>
    <textarea name="description" required><!?= htmlspecialchars($service['description']) ?></textarea>

    <label for="image">Changer l'image:</label>
    <input type="file" name="image" id="file-selector">
    
    <div id="preview-container">
        <!?php if (!empty($service['images'])): ?>
            <img src="../assets/services/<!?= htmlspecialchars(json_decode($service['images'])[0]) ?>" alt="Image actuelle" width="100">
        <!?php endif; ?>
    </div>

    <button type="submit">Modifier</button>
</form>

<div id="message"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#file-selector").change(function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview-container").html('<img src="' + e.target.result + '" width="100">'); // Affiche l'aperçu de l'image
                };
                reader.readAsDataURL(file);
            }
        });

        // Soumettre le formulaire via AJAX
        $("#updateForm").on("submit", function(e) {
            e.preventDefault(); // Empêche le rechargement de la page

            var formData = new FormData(this);
            $.ajax({
                url: "update_service.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#message").html(response);
                    // Optionnel : Vous pouvez également afficher les nouvelles informations ici sans recharger la page
                },
                error: function() {
                    $("#message").html("<p class='error'>Erreur lors de la mise à jour.</p>");
                }
            });
        });
    });
</script>
---->











<!------------------------------------------------------------>






<!--?php
include '../config/database.php';
include '../connfig/config_unv.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $images = json_encode(explode(',', $_POST["images"]));

    $stmt = $pdo->prepare("UPDATE services SET nom = ?, description = ?, images = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Habitat- Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .image-preview img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            border: 1px solid #ddd;
            object-fit: cover;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-edit"></i> Modifier Habitat</h2>
    
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($habitat['nom']) ?>" required>

        <label>Images :</label>
        <input type="text" name="images" value="<?= implode(',', json_decode($habitat['images'], true)) ?>" required>
        
        <div class="image-preview">
            <?php 
            $images = json_decode($habitat["images"], true);
            foreach ($images as $image) {
                echo "<img src='../assets/services/$image'>";
            }
            ?>
        </div>



        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($habitat['description']) ?></textarea>




        <button type="submit"><i class="fas fa-save"></i> Modifier</button>
    </form>
</div>

</body>
</html>