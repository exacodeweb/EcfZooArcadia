<?php
//include '../config/database.php';
require_once '../config/config_unv.php';

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
        <input type="text" name="nom" value="<?= htmlspecialchars($habitat['nom']) ?>" required>

        <label>Images :</label>
        <input type="text" name="images" value="<?= implode(',', json_decode($habitat['images'], true)) ?>" required>
        
        <div class="image-preview">
            <?php 
            $images = json_decode($habitat["images"], true);
            foreach ($images as $image) {
                echo "<img src='../assets/images/$image'>";
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
