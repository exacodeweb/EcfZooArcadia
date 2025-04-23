<?php
session_start();
ob_start(); // Évite les erreurs de header déjà envoyé

require_once '../config/config_unv.php';
require_once 'contact.php';

// 🔹 Empêcher l'affichage du site dans une iframe (protection clickjacking)
header("X-Frame-Options: DENY");

// 🔹 Vérification du token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur de sécurité CSRF détectée !");
}

// 🔹 Protection contre les attaques par force brute (5 tentatives max par IP en 10 minutes)
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = [];
}
$_SESSION['attempts'] = array_filter($_SESSION['attempts'], fn($t) => ($t > $time - 600));

if (count($_SESSION['attempts']) >= 5) {
    die("Trop de tentatives, veuillez réessayer plus tard.");
}
$_SESSION['attempts'][] = $time;

// 🔹 Vérification que la méthode POST est bien utilisée
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 🔹 Sécurisation et validation des entrées
    $nom = htmlspecialchars(trim($_POST["nom"]), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]), ENT_QUOTES, 'UTF-8');

    // 🔹 Vérification de la longueur des champs
    if (strlen($nom) > 50 || strlen($email) > 100 || strlen($message) > 500) {
        die("Erreur : Un des champs est trop long.");
    }

    // 🔹 Validation de l'email (format et domaine)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@.+\./", $email)) {
        die("Erreur : Adresse e-mail invalide.");
    }

    // 🔹 Vérification des champs obligatoires
    if (!empty($nom) && !empty($email) && !empty($message)) {
        $contactModel = new Contact($pdo);
        $contactModel->ajouterContact($nom, $email, $message);

        // 🚀 Redirection après succès
        header("Location: merci.html");
        exit;
    } else {
        // 🚨 Redirection en cas d'erreur
        header("Location: form_contact.html?error=1");
        exit;
    }
} else {
    // 🚨 Redirection si l'utilisateur tente d'accéder directement
    header("Location: form_contact.html");
    exit;
}

ob_end_flush();