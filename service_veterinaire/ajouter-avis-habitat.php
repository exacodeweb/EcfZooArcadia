<?php
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données
    $habitat_id = isset($_POST['habitat_id']) ? intval($_POST['habitat_id']) : null;
    $veterinaire_id = isset($_POST['veterinaire_id']) ? intval($_POST['veterinaire_id']) : null;
    $commentaire = isset($_POST['commentaire']) ? trim(htmlspecialchars($_POST['commentaire'])) : null;

    // Vérification des champs requis
    if (empty($habitat_id) || empty($veterinaire_id) || empty($commentaire)) {
        die("Erreur : Tous les champs sont requis.");
    }

    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Insertion sécurisée des données
        $stmt = $pdo->prepare("INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire, date_creation) 
                               VALUES (:habitat_id, :veterinaire_id, :commentaire, NOW())");

        $stmt->execute([
            ':habitat_id' => $habitat_id,
            ':veterinaire_id' => $veterinaire_id,
            ':commentaire' => $commentaire
        ]);

        echo "<p style='color: green; font-weight: bold;'>Avis ajouté avec succès !</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red; font-weight: bold;'>Erreur lors de l'ajout de l'avis : " . $e->getMessage() . "</p>";
    }
}
?>
















<?php
//require_once 'utilise.php';
require_once '../config/config_unv.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitat_id = $_POST['habitat_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $commentaire = $_POST['commentaire'];

    if (empty($habitat_id) || empty($veterinaire_id) || empty($commentaire)) {
        die("Erreur : Tous les champs sont requis.");
    }

    $pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->prepare("INSERT INTO avis_habitats (habitat_id, veterinaire_id, commentaire, date_creation) 
                           VALUES (?, ?, ?, NOW())");
    $stmt->execute([$habitat_id, $veterinaire_id, $commentaire]);

    echo "Avis ajouté avec succès !";
}
?>-->