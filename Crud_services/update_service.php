<!--?php
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];

    // Récupérer l'image actuelle
    $stmt = $pdo->prepare("SELECT images FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImages = json_decode($service["images"], true);

    // Vérifier si une nouvelle image a été envoyée
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../assets/services/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Vérifier et déplacer l’image
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $images = json_encode([$fileName]); // Stocke le nouveau fichier
        } else {
            echo "<p class='error'>Erreur lors de l’upload de l’image.</p>";
            exit;
        }
    } else {
        $images = json_encode($currentImages); // Garde l'image actuelle
    }

    // Mise à jour des données
    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>-->








<!--?php
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];

    // Récupérer l'image actuelle
    $stmt = $pdo->prepare("SELECT images FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImages = json_decode($service["images"], true);

    //-----------------------------------------------------
    // Vérifier si une nouvelle image a été envoyée
    if (!empty($_FILES["image"]["name"])) {
      $targetDir = "../assets/services/";
      $fileName = basename($_FILES["image"]["name"]);
      $targetFilePath = $targetDir . $fileName;

      // Vérifier et déplacer l’image
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
          $images = json_encode([$fileName]); // Stocke le nouveau fichier
      } else {
          echo "<p class='error'>Erreur lors de l’upload de l’image.</p>";
          exit;
      }
  } else {
      $images = json_encode($currentImages); // Garde l'image actuelle
  }
    //-----------------------------------------------------

    // Mise à jour des données
    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>


<!-?php
require_once '../config/config_unv.php';

function cleanFileName($filename) {
    // Supprime les accents et caractères spéciaux
    $filename = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
    // Remplace les caractères non valides par un "_"
    $filename = preg_replace('/[^A-Za-z0-9.-]/', '_', $filename);
    return $filename;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];

    // Récupérer l'image actuelle
    $stmt = $pdo->prepare("SELECT images FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImage = json_decode($service["images"], true)[0]; // Extraire le nom proprement

    //-----------------------------------------------------
    // Vérifier si une nouvelle image a été envoyée
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../assets/services/";
        $fileName = cleanFileName(time() . "_" . basename($_FILES["image"]["name"]));
        $targetFilePath = $targetDir . $fileName;

        // Déplacer l’image
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $imageToSave = $fileName; // Utiliser le nouveau nom nettoyé
        } else {
            echo "<p class='error'>❌ Erreur lors de l’upload de l’image.</p>";
            exit;
        }
    } else {
        $imageToSave = $currentImage; // Garder l'ancienne image si aucune nouvelle n'est sélectionnée
    }
    //-----------------------------------------------------

    // Mise à jour des données
    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, json_encode([$imageToSave]), $description, $id])) {
        echo "<p class='success'>✅ Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>❌ Erreur lors de la modification.</p>";
    }
}
?>



<?php
require_once '../config/config_unv.php';

function cleanFileName($filename) {
    // Supprime les accents et les caractères spéciaux pour éviter les problèmes
    $filename = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);
    $filename = preg_replace('/[^A-Za-z0-9\-\_\.]/', '', $filename); // Retire les caractères non autorisés
    return $filename;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $description = $_POST["description"];

    // Récupérer l'image actuelle du service
    $stmt = $pdo->prepare("SELECT images FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImages = json_decode($service["images"], true);
    $currentImage = $currentImages ? $currentImages[0] : '';

    // Vérifier si une nouvelle image a été envoyée
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../assets/services/"; // Répertoire de stockage
        $fileName = cleanFileName(basename($_FILES["image"]["name"])); // Nettoyer le nom du fichier
        $targetFilePath = $targetDir . $fileName;

        // Déplacer l’image dans le répertoire
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $images = json_encode([$fileName]); // On met à jour le tableau avec la nouvelle image
        } else {
            echo "<p class='error'>Erreur lors de l’upload de l’image.</p>";
            exit;
        }
    } else {
        // Pas de nouvelle image, conserver l'ancienne
        $images = json_encode([$currentImage]);
    }

    // Mise à jour des données dans la base de données
    $stmt = $pdo->prepare("UPDATE services SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $images, $description, $id])) {
        echo "<p class='success'>Service modifié avec succès !</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification.</p>";
    }
}
?>