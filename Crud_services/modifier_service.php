<?php  
require_once '../config/config_unv.php';

$message = ""; // Pour afficher un message dans l'en-tête du formulaire

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
            $message = "Service modifié avec succès !";
        } else {
            $message = "Erreur lors de la mise à jour.";
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
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
        .image-preview img {
            max-width: 100px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Modifier un Service</h2>

    <?php if (!empty($message)) : ?>
        <div class="alert"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

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
