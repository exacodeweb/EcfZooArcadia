
<?php
session_start();
//require 'utilise.php'; // Fichier de connexion à la BDD
require '../../config_unv.php';

// Vérification du jeton CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Requête invalide.");
}

// Nettoyage des entrées utilisateur
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$password = trim($_POST['password']);

if (!$email || empty($password)) {
    $_SESSION['error'] = "Email ou mot de passe incorrect.";
    header("Location: login-test.php");
    exit;
}

// Protection contre le Brute Force : Compter les tentatives de connexion
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if ($_SESSION['login_attempts'] >= 5) {
    die("Trop de tentatives. Réessayez plus tard.");
}

// Requête préparée pour éviter les injections SQL
$stmt = $pdo->prepare("SELECT id, nom, role, mot_de_passe FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['mot_de_passe'])) {
    // Réinitialisation du compteur d'échecs
    $_SESSION['login_attempts'] = 0;

    // Stocker les infos de l'utilisateur en session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_role'] = $user['role'];

    header("Location: ../pages/admin_dashboard.php");
    exit;
} else {
    $_SESSION['error'] = "Email ou mot de passe incorrect.";
    $_SESSION['login_attempts']++; // Incrémenter le compteur d'échecs
    header("Location: login-test.php");
    exit;
}
?>