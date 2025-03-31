<?php
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données textuelles du formulaire
    $nom = $_POST["nom"];
    $description = $_POST["description"];

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
    $stmt = $pdo->prepare("INSERT INTO habitats (nom, images, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $imagesJson, $description])) {
        echo "Habitat ajouté avec succès !";
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
        <h2><i class="fas fa-home"></i> Ajouter un Habitat</h2>
        <!-- Le formulaire d'ajout d'habitat -->
        <form method="post" enctype="multipart/form-data">
            <label>Nom de l'habitat :</label>
            <input type="text" name="nom" required>

            <label>Images :</label>
            <input type="file" name="images[]" id="images" accept="image/*" multiple required>
            <div class="image-preview" id="image-preview"></div>

            <label>Description :</label>
            <textarea name="description" required></textarea>

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