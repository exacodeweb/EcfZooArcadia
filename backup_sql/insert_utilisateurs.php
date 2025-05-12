<?php
// Inclure la configuration de la base de données
$config = include './config/config.php';

try {
    // Connexion à la base de données
    $pdo = new PDO(
        "mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['database'] . ";charset=" . $config['db']['charset'],
        $config['db']['username'],
        $config['db']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Hacher les mots de passe
$mot_de_passe_admin = password_hash('José!2024', PASSWORD_BCRYPT);//admin123
$mot_de_passe_employe = password_hash('Martin!2024', PASSWORD_BCRYPT);//employe123
$mot_de_passe_veto = password_hash('vet123', PASSWORD_BCRYPT);

try {
    // Préparer et exécuter les requêtes d'insertion
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(['Admin', 'José', 'admin@example.com', $mot_de_passe_admin, 'admin']);
    $stmt->execute(['Employe', 'Martin', 'employe@example.com', $mot_de_passe_employe, 'employe']);
    $stmt->execute(['Veto', 'Roux', 'veterinaire@example.com', $mot_de_passe_veto, 'veterinaire']);

    echo "Utilisateurs insérés avec succès !";
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion des utilisateurs : " . $e->getMessage();
}
?>
