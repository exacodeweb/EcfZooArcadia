<?php
session_start();
if (!isset($_SESSION['utilisateur_role']) || $_SESSION['utilisateur_role'] !== 'veterinaire') {
    die("Accès refusé.");
}

require './config_unv.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $habitat_id = $_POST['habitat_id'] ?? null;
    $commentaire = $_POST['commentaire'] ?? null;
    $veterinaire_id = $_SESSION['utilisateur_id'];

    if ($habitat_id && $commentaire) {
        try {
            $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "ZOO_Arcadia!2024", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            $sql = "INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire, date_avis)
                    VALUES (:habitat_id, :veterinaire_id, :commentaire, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
            $stmt->bindParam(':veterinaire_id', $veterinaire_id, PDO::PARAM_INT);
            $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
            $stmt->execute();

            // Redirection après succès
            header("Location: tableau_de_bord.php?message=avis_ajoute");
            exit;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>
