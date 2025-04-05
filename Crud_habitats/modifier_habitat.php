<?php 
require_once '../config/config_unv.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
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
            $destination = '../assets/images/' . basename($_FILES['image']['name']);
            
            if (move_uploaded_file($tmpName, $destination)) {
                $imagesArray[0] = basename($_FILES['image']['name']); 
            }
        }
        
        $imagesJson = json_encode([$imagesArray[0]]); 

        $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
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

        /*.message { text-align: center; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 10px; }*/

        label { font-weight: bold; display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .image-preview img { max-width: 100px; border-radius: 5px; border: 1px solid #ddd; }
        .btn { background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; margin-top: 10px; }
        .btn:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Modifier un Habitat</h2>

    <!--?php echo "<p class='message'> Habitat modifié avec succès !</p>"; ?>-->

    <form method="post" enctype="multipart/form-data">
        <label>Nom de l'habitat :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($service['nom']); ?>" required>
        
        <label>Image principale :</label>
        <input type="file" name="image" accept="image/*">
        <div class="image-preview">
            <img src="../assets/images/<?= htmlspecialchars(json_decode($service['images'])[0] ?? ''); ?>" alt="Image" />
        </div>
        
        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($service['description']); ?></textarea>
        
        <button type="submit" class="btn">Modifier Service</button>
    </form>
</div>
</body>
</html>










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
<!-----------------------------------------------au départ------------------------------------------------------------------>
<!--?php
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

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
</div>

</body>
</html>
-->
<!--------------------------------------------------------------------------------------------------------------------->















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
<!----------------------------------------------------------------------->

