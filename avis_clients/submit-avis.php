<?php
include './db.php';// ../includes/db-connection.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $nom = htmlspecialchars($_POST['nom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = intval($_POST['note']);

    $sql = "INSERT INTO avisclients (service_id, nom, commentaire, note) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$service_id, $nom, $commentaire, $note]);

    header("Location: ./service-details.php?id=$service_id");
    exit();
}
?>

<!--?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0; // Vérifie que service_id est bien récupéré
    $nom = htmlspecialchars($_POST['nom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = intval($_POST['note']);

    // Vérifier que le service_id existe bien dans la table services
    $checkService = $pdo->prepare("SELECT id FROM services WHERE id = ?");
    $checkService->execute([$service_id]);
    
    if ($checkService->rowCount() > 0) {
        $sql = "INSERT INTO avisclients (service_id, nom, commentaire, note) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$service_id, $nom, $commentaire, $note]);
        echo "Avis ajouté avec succès.";
    } else {
        echo "Erreur : le service sélectionné n'existe pas.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>-->

<?php
include '../includes/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0;
    $nom = htmlspecialchars($_POST['nom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = intval($_POST['note']);

    // Vérifier que le service_id existe dans la table services
    $checkService = $pdo->prepare("SELECT id FROM services WHERE id = ?");
    $checkService->execute([$service_id]);

    if ($checkService->rowCount() > 0) {
        $sql = "INSERT INTO avisclients (service_id, nom, commentaire, note) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$service_id, $nom, $commentaire, $note]);
        echo "Avis ajouté avec succès.";
    } else {
        echo "Erreur : le service sélectionné n'existe pas.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
