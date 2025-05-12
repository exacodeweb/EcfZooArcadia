<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur connecté est bien un administrateur
if ($_SESSION['role'] !== 'admin') {
    // Si ce n'est pas un admin, rediriger vers la page de connexion
    header("Location: ../config/login.php");
    exit;
}

// Inclure le fichier de connexion à la base de données
require_once '../config/config_unv.php';

// Vérifier si le formulaire a été soumis en POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécuriser les données reçues du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Valider l'email
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT); // Hacher le mot de passe
    $role = htmlspecialchars($_POST['role']);

    // Si l'email n'est pas valide, arrêter l'exécution
    if (!$email) {
        die("Email invalide !");
    }

    // Vérifier si un utilisateur avec cet email existe déjà
    $sql_check = "SELECT id FROM utilisateurs WHERE email = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$email]);
    if ($stmt_check->fetch()) {
        // Si l'email existe déjà, stopper avec un message d'erreur
        die("Cet email est déjà utilisé !");
    }

    // Préparer la requête d'insertion pour ajouter le nouvel utilisateur
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, date_creation) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);

    // Exécuter l'insertion
    if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe, $role])) {
        // En cas de succès, rediriger vers la liste des utilisateurs
        header("Location: liste.php");
        exit;
    } else {
        // Sinon, afficher un message d'erreur
        echo "Erreur lors de l'ajout.";
    }
}
?>



<!--?php // insérer les données dans la base.
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

require_once '../config/config_unv.php'; // a testé

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = htmlspecialchars($_POST['role']);

    if (!$email) {
        die("Email invalide !");
    }

    // Vérifier si l'email existe déjà
    $sql_check = "SELECT id FROM utilisateurs WHERE email = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$email]);
    if ($stmt_check->fetch()) {
        die("Cet email est déjà utilisé !");
    }

    // Insérer l'employé
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, date_creation) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe, $role])) {
        header("Location: liste.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout.";
    }
}
?> ------------------->