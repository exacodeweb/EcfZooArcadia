
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include './includes/db-connection.php';
include './config/config_unv.php';

// Récupérer l'ID du service depuis l'URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails du service
$sql = "SELECT nom, description, images FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$serviceId]);
$service = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails du Service</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      /*padding: 1rem;*/
    }
    .service-details {
      background: #fff;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }
    .service-details h1 {
      font-size: clamp(24px, 5vw, 48px);
      margin-bottom: 1rem;
      text-align: center;
    }
    .service-details p {
      font-size: 1.1rem;
      text-align: center;
      color: #555;
    }
    .service-images {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: center;
      margin-top: 1rem;
    }
    .service-images img {
      border-radius: 0.5rem;
      object-fit: cover;
      width: 30%;
      height: 200px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    @media (max-width: 768px) {
      .service-images img {
        width: 100%;
      }
    }
    .specifications {
      margin-top: 2rem;
    }
    .specifications h2 {
      text-align: center;
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }
    .specifications ul {
      list-style: none;
      padding: 0;
    }
    .specifications li {
      background: #e9ecef;
      margin-bottom: 0.5rem;
      padding: 0.75rem;
      border-radius: 0.5rem;
      font-size: 1rem;
    }
    .specifications li strong {
      color: #007bff;
    }
  </style>

<style>
    /*-- FIL D'ARIANE --*/
    .breadcrumb-item {
      width: 100%;
      background: none;
      margin-left: 0px;
      margin-top: 0px;
      margin-bottom: 0px;
      /*rajouter en option*/
      display: block;
      flex-direction: row;
      align-content: center;
      align-items: center;
      padding: 5px;
    }
  </style>

</head>
<body>
  <?php include './includes/header.php'; ?>

  <!--FIL D'ARIANE-->
  <div class="breadcrumb-item">
    <a href="../index.php" class="link-rep">Accueil</a> /
    <a href="./services.php" class="link-rep">Services</a> / Détails
  </div>

<!-------------------------------------------------------->
<!--?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include './includes/db-connection.php';

// Récupérer l'ID du service depuis l'URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails du service
$sql = "SELECT nom, description, images FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$serviceId]);
$service = $stmt->fetch();

?>-->
<!-------------------------------------------------------->



  <div class="container my-4">
    <?php if ($service): ?>
      <div class="service-details">
        <h1><?= htmlspecialchars($service['nom']) ?></h1>
        <p><?= htmlspecialchars($service['description']) ?></p>
        <?php 
          $images = json_decode($service['images']);
          if ($images) {
            echo '<div class="service-images">';
            foreach ($images as $image) {
              echo '<img src="./assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
            }
            echo '</div>';
          }
        ?>
      </div>
      
      <?php 
        $sql = "SELECT titre, valeur FROM specifications WHERE service_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$serviceId]);
        $specifications = $stmt->fetchAll();
      ?>
      <?php if ($specifications): ?>
        <div class="specifications">
          <h2>Spécificités</h2>
          <ul>
            <?php foreach ($specifications as $spec): ?>
              <li><strong><?= htmlspecialchars($spec['titre']) ?>:</strong> <?= htmlspecialchars($spec['valeur']) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="alert alert-danger text-center">Service non trouvé.</div>
    <?php endif; ?>

  </div>
  <?php include './includes/footer.php'; ?>
  <!-- Bootstrap JS Bundle -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!--------------------------------------------------------------------------------------------------------------------->

<!--?php
require_once './config/config_unv.php';

// Vérifier si l'ID du service est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données du service depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les images supplémentaires liées au service
    $stmt_images = $pdo->prepare("SELECT * FROM service_images WHERE service_id = ?");
    $stmt_images->execute([$id]);
    $images = $stmt_images->fetchAll(PDO::FETCH_ASSOC);

    if (!$service) {
        echo "Service non trouvé.";
        exit;
    }

    // Traitement du formulaire d'édition des images
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Traitement de la modification de l'image principale
        if (isset($_FILES['image_principale']) && $_FILES['image_principale']['error'] == 0) { //image_principale
            $image_principale = $_FILES['image_principale']['name'];
            move_uploaded_file($_FILES['image_principale']['tmp_name'], '../assets/services/' . $image_principale);

            // Mise à jour de l'image principale
            $stmt = $pdo->prepare("UPDATE services SET image_principale = ? WHERE id = ?");
            $stmt->execute([$image_principale, $id]);
        }

        // Traitement de l'ajout de nouvelles images supplémentaires
        if (isset($_FILES['image_supplementaire'])) {
            foreach ($_FILES['image_supplementaire']['name'] as $key => $name) {
                if (!empty($name)) {
                    $tmpName = $_FILES['image_supplementaire']['tmp_name'][$key];
                    $destination = '../assets/services/' . basename($name);
                    move_uploaded_file($tmpName, $destination);

                    // Ajout de l'image supplémentaire à la table service_images
                    $stmt = $pdo->prepare("INSERT INTO service_images (service_id, image) VALUES (?, ?)");
                    $stmt->execute([$id, basename($name)]);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Service</title>
</head>
<body> ------------------>


  <!--FIL D'ARIANE-->  <!------------------------------------
  <div class="breadcrumb-item">
    <a href="../index.php" class="link-rep">Accueil</a> /
    <a href="./liste-habitats.php" class="link-rep">Habitats</a> / Détails
  </div>


<h2>Détails du Service : <!?= htmlspecialchars($service['nom']) ?></h2>              ----------------->

<!-- Affichage de l'image principale --> <!-------------------------
<div>
    <h3>Image principale</h3>
    <img src="../assets/services/<!?= htmlspecialchars($service['image_principale']) ?>" alt="Image principale" width="300">
</div> ----------------------->

<!-- Formulaire pour modifier l'image principale -->  <!------------------------
<form method="post" enctype="multipart/form-data">
    <label for="image_principale">Modifier l'image principale :</label>
    <input type="file" name="image_principale" accept="image/*">
    <button type="submit">Modifier l'image principale</button>
</form>      ------------------>
 
<!-- Affichage des images supplémentaires --> <!---------------------
<div>
    <h3>Images supplémentaires</h3>
    <!?php foreach ($images as $image): ?>
        <img src="../assets/services/<!?= htmlspecialchars($image['image']) ?>" alt="Image supplémentaire" width="150">
    <!?php endforeach; ?>
</div>


<!?php 
          $images = json_decode($service['images']);
          if ($images) {
            echo '<div class="service-images">';
            foreach ($images as $image) {
              echo '<img src="../assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
            }
            echo '</div>';
          }
        ?>
---------------------------->

<!-- Formulaire pour ajouter des images supplémentaires -->  <!--------------------------
<form method="post" enctype="multipart/form-data">
    <label for="image_supplementaire">Ajouter des images supplémentaires :</label>
    <input type="file" name="image_supplementaire[]" accept="image/*" multiple>
    <button type="submit">Ajouter des images</button>
</form>

</body>
</html>

--------------------------->


















<!--!DOCTYPE html>
<html lang="fr en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1,
    h2,
    p {
      text-align: center;
      color: #2c3e50;
    }

    /* Ajustement du texte dans les sections */
    h1,
    h2 {
      font-size: 1.5em;
    }

    h1 {
      font-size: clamp(24px, 5vw, 48px) !important;
      /* Min 24px, Max 48px */
      text-align: center !important;
      margin: 1rem 0;
      line-height: 1.2;
      /*color: #ffff;*/
      /*font-weight: 500;*/ /*desactivé */
    }

    /* Habitat Details Section */
    .habitat-details {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .habitat-details p {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
    }

    /* Images Section */
    .images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }

    .images img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-height: 200px;
      /* ajouter par moi */
      height: 200px;
      object-fit: cover;
      width: 30%;
    }

    /* Animal List Section */
    .animal-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .animal-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 200px;
      text-align: center;
      padding: 15px;
    }

    .animal-card img {
      /*width: 100%;*/
      border-radius: 8px;
      /*height: auto;*/
      max-height: 150px;

      /* ajouter par moi */
      height: 150px;
      object-fit: cover;
      /*width: 100%;*/
      max-width: 200px;
      width: 200px;

    }

    .animal-card h3 {
      font-size: 18px;
      margin: 10px 0;
      color: #2c3e50;
    }

    .animal-card .btn {
      display: inline-block;
      padding: 10px 15px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
      font-size: 14px;
    }

    .animal-card .btn:hover {
      background: #2980b9;
    }

    /* Error Message */
    .error {
      text-align: center;
      color: #e74c3c;
      font-size: 18px;
    }

    /*-- Responsive --*/
    @media (max-width: 768px) {
      .images {
        display: flex;
        flex-direction: column;
      }

      .images img {
        max-width: 500px !important;
        width: 100% !important;
      }

      .animal-card {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        width: 100%;
      }

      .img {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        width: 100% !important;

      }
    }
  </style>

  <style>
    /* Global Styles */
    /*
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}*/

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1,
    h2,
    p {
      text-align: center;
      color: #2c3e50;
    }

    /* Habitat Details Section */
    .habitat-details {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .habitat-details p {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
    }

    /* Images Section */
    .images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;


    }

    .images img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-height: 200px;
      /* ajouter par moi */
      height: 200px;
      object-fit: cover;
      width: 30%;
    }

    /* Animal List Section */
    .animal-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      /*20px*/
      justify-content: center;
    }

    .animal-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 230px;
      text-align: center;
      padding: 15px;
    }

    .animal-card img {
      /*width: 100%;*/
      border-radius: 8px;
      /*height: auto;*/
      max-height: 150px;

      /* ajouter par moi */
      height: 150px;
      object-fit: cover;
      /*width: 100%;*/
      max-width: 200px;
      width: 200px;

    }

    .animal-card h3 {
      font-size: 18px;
      margin: 10px 0;
      color: #2c3e50;
    }

    .animal-card .btn {
      display: inline-block;
      padding: 10px 15px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
      font-size: 14px;
    }

    /*.btn {
    height: 42px;
    width: 140px;
}*/

    .animal-card .btn:hover {
      background: #2980b9;
    }

    /* Error Message */
    .error {
      text-align: center;
      color: #e74c3c;
      font-size: 18px;
    }


    /*-- Responsive --*/
    @media (max-width: 768px) {
      .images {
        display: flex;
        flex-direction: column;
      }

      .images img {
        max-width: 500px !important;
        width: 100% !important;
      }

      .animal-card {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        width: 100%;
      }

      .img {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        width: 100% !important;

      }
    }
  </style>
  </style>
    -->

  <!-------------------------------------------------------- NEW STYLE -->
<!--
  <style>
    /* Menu toggle */
    @media (max-width: 768px) {

      .nav-links {
        /*position: absolute;*/
        background-color: #2A7E50;
        /*width: 100%;*/
        /*top: 70px;*/
        left: 0;
      }

      .nav-links li {
        margin: 0.5rem 0;
        /*0.5rem*/
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {

      .nav-links.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        color: white;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .nav-links {
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        background-color: rgba(0, 0, 0, 0.8);
        /*background-color: #2A7E50;*/
        position: absolute;
        top: 107px;
        /*70px*/
        /* Ajustez selon la hauteur du header */
        right: 0;
        width: 100%;
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
      }
    }
  </style>

  <style>

    /* Menu toggle */
    @media (max-width: 768px) {

      .nav-links {
        /*position: absolute;*/
        background-color: #2A7E50;
        /*width: 100%;*/
        /*top: 70px;*/
        left: 0;
      }

      .nav-links li {
        margin: 0.5rem 0;
        /*0.5rem*/
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {

      .nav-links.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        color: white;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .nav-links {
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        background-color: rgba(0, 0, 0, 0.8);
        /*background-color: #2A7E50;*/
        position: absolute;
        top: 107px;
        /*70px*/
        /* Ajustez selon la hauteur du header */
        right: 0;
        width: 100%;
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
      }
    }
  </style>

</head>
<body>
    -->
<!--?php include './includes/header.php'; ?>

<!?php
include './includes/db-connection.php';

// Récupérer l'ID du service depuis l'URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails du service
$sql = "SELECT nom, description, images FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$serviceId]);
$service = $stmt->fetch();

if ($service) {
    echo '<div class="habitat-details">';
    echo '<h1>' . htmlspecialchars($service['nom']) . '</h1>';
    echo '<p>' . htmlspecialchars($service['description']) . '</p>';

    // Afficher les images du service
    $images = json_decode($service['images']);
    echo '<div class="images">';
    foreach ($images as $image) {
        echo '<img src="./assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
    }
    echo '</div>';
    echo '</div>';

    // Récupérer les animaux associés à cet habitat
    //$sqlAnimals = "SELECT id, prenom, race, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM services WHERE service_id = ?";
    //$stmtAnimals = $pdo->prepare($sqlAnimals);
    //$stmtAnimals->execute([$serviceId]);

    //echo '<h2>Animaux dans cet habitat</h2>';
    //echo '<div class="animal-list">';
    //while ($animal = $stmtAnimals->fetch()) {
      //  echo '<div class="animal-card">';
       // echo '<img src="./assets/images/' . htmlspecialchars($animal['image']) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
       // echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';
       // echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
       // echo '</div>';
    //}
    //echo '</div>';

  


    //include './includes/db-connection.php';
    
    // Récupérer l'ID du service depuis l'URL
    //$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Récupérer les détails du service
    //$sql = "SELECT nom, description, images, specificites FROM services WHERE id = ?";
    //$stmt = $pdo->prepare($sql);
    //$stmt->execute([$serviceId]);
    //$service = $stmt->fetch();
    
    //if ($service) {
      //  echo '<div class="service-details">';
      //  echo '<h1>' . htmlspecialchars($service['nom']) . '</h1>';
      //  echo '<p>' . nl2br(htmlspecialchars($service['description'])) . '</p>';
    
        // Afficher les images du service
      //  $images = json_decode($service['images']);
      //  echo '<div class="images">';
      //  foreach ($images as $image) {
        //    echo '<img src="./assets/services/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($service['nom']) . '">';
      //  }
      //  echo '</div>';
    
        // Afficher les spécificités du service sous forme de liste
      //  if (!empty($service['specificites'])) {
        //    echo '<h2>Spécificités</h2>';
        //    echo '<ul>';
        //    $specificites = explode("\n", $service['specificites']);
        //    foreach ($specificites as $spec) {
        //        echo '<li>' . htmlspecialchars($spec) . '</li>';
        //    }
        //    echo '</ul>';
      //  }
    
      //  echo '</div>';
    //} else {
      //  echo '<p class="error">Service non trouvé.</p>';
    //}
    





    $sql = "SELECT titre, valeur FROM specifications WHERE service_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$serviceId]);
    $specifications = $stmt->fetchAll();
    
    if ($specifications) {
        echo '<h2>Spécificités</h2>';
        echo '<ul>';
        foreach ($specifications as $spec) {
            echo '<li><strong>' . htmlspecialchars($spec['titre']) . ':</strong> ' . htmlspecialchars($spec['valeur']) . '</li>';
        }
        echo '</ul>';
    }











} else {
    echo '<p class="error">Service non trouvé.</p>';
}
?>

</body>

<section class="footer">
<!?php include './includes/footer.php';?>
</section>

</html>
