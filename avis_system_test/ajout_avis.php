<?php
// Configuration de la base de données
$host = "localhost";
$dbname = "zoo_arcadia";
$username = "root"; // Remplacez par votre utilisateur MySQL
$password = "G1i9e6t3";     // Remplacez par votre mot de passe MySQL

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Récupérer les données du formulaire
        $nom = htmlspecialchars($_POST['nom']); // Protection contre les injections XSS
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $note = (int)$_POST['note'];

        // Insérer les données dans la base
        $query = "INSERT INTO avis (nom, commentaire, note) VALUES (:nom, :commentaire, :note)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':note', $note);

        if ($stmt->execute()) {
            echo "Avis ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout de l'avis.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>