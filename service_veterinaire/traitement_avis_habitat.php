<?php
session_start();
require './config_unv.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "ZOO_Arcadia!2024", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Connexion réussie : on enregistre le rôle
        $_SESSION['utilisateur_id'] = $user['id'];
        $_SESSION['utilisateur_role'] = $user['role'];

        // Pour vétérinaire uniquement
        if ($user['role'] === 'veterinaire') {
            $_SESSION['veterinaire_id'] = $user['id'];
        }

        header("Location: tableau_de_bord.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>




<?php
require './config_unv.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if (
            empty($_POST['habitat_id']) ||
            empty($_POST['veterinaire_id']) ||
            empty(trim($_POST['commentaire']))
        ) {
            throw new Exception("Tous les champs sont obligatoires !");
        }

        $habitat_id = (int) $_POST['habitat_id'];
        $veterinaire_id = (int) $_POST['veterinaire_id'];
        $commentaire = trim($_POST['commentaire']);

        $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "Z00_Arcadia!2024", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $sql = "INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire, date_creation)
                VALUES (:habitat_id, :veterinaire_id, :commentaire, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
        $stmt->bindParam(':veterinaire_id', $veterinaire_id, PDO::PARAM_INT);
        $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: avis_habitat_success.php?message=Avis ajouté avec succès !");
            exit;
        } else {
            throw new Exception("Erreur lors de l'ajout de l'avis.");
        }

    } catch (Exception $e) {
        header("Location: avis_habitat_error.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    header("Location: avis_habitat.php");
    exit;
}
?>















<!--?php
require './config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Vérifier que toutes les valeurs sont bien présentes
        if (!isset($_POST['habitat_id'], $_POST['veterinaire_id'], $_POST['commentaire'])) {
            throw new Exception("Tous les champs sont obligatoires !");
        }

        $habitat_id = intval($_POST['habitat_id']);
        $veterinaire_id = intval($_POST['veterinaire_id']);
        $commentaire = trim($_POST['commentaire']);

        // Vérifier que les valeurs ne sont pas vides après conversion
        if (empty($habitat_id) || empty($veterinaire_id) || empty($commentaire)) {
            throw new Exception("Tous les champs sont obligatoires !");
        }

        // Connexion à la base de données
        //$pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
        $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "Zoo_Arcadia!2024", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Préparation de la requête sécurisée
        $sql = "INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire, date_creation) VALUES (:habitat_id, :veterinaire_id, :commentaire, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
        $stmt->bindParam(':veterinaire_id', $veterinaire_id, PDO::PARAM_INT);
        $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Redirection avec message de succès
            header("Location: avis_habitat_success.php?message=Avis ajouté avec succès !");
            exit;
        } else {
            throw new Exception("Erreur lors de l'ajout de l'avis.");
        }
    } catch (Exception $e) {
        // Redirection avec message d'erreur
        header("Location: avis_habitat_error.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Redirection si la page est accédée sans POST
    header("Location: avis_habitat.php");
    exit;
}
?>


      -->












<!--?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitat_id = $_POST['habitat_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $commentaire = trim($_POST['commentaire']);

    // Vérification des données
    if (empty($habitat_id) || empty($veterinaire_id) || empty($commentaire)) {
        die("Tous les champs sont obligatoires !");
    }

    // Insertion dans la base de données
    $sql = "INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$habitat_id, $veterinaire_id, $commentaire])) {
        echo "Avis ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'avis.";
    }
}
?>