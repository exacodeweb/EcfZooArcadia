<?php
require_once './config.php';

if (!empty($_POST['auteur']) && !empty($_POST['message'])) {
    $auteur = htmlspecialchars($_POST['auteur']);
    $message = htmlspecialchars($_POST['message']);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO avis (message, auteur, statut) VALUES (:message, :auteur, 'en_attente')");
        $stmt->execute([
            ':message' => $message,
            ':auteur' => $auteur
        ]);

        echo "Merci pour votre avis ! Il sera modéré avant d'être publié.";
    } catch (PDOException $e) {
        echo "Erreur lors de la soumission : " . $e->getMessage();
    }
} else {
    echo "Tous les champs sont requis.";
}
?>