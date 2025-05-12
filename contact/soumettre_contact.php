<?php
session_start();// (traitement serveur)
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
// Limite le nombre de tentatives par IP (anti brute-force : max 5 en 10 min)
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

    // 🔹 Vérification de la longueur des champs pour éviter les abus
    if (strlen($nom) > 50 || strlen($email) > 100 || strlen($message) > 500) {
        die("Erreur : Un des champs est trop long.");
    }

    // 🔹 Validation de l'email (format et domaine) Vérifie le format de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@.+\./", $email)) {
        die("Erreur : Adresse e-mail invalide.");
    }

    // 🔹 Vérification des champs obligatoires 
    // Si tout est bon, on enregistre la demande dans la base de données
    if (!empty($nom) && !empty($email) && !empty($message)) {
        $contactModel = new Contact($pdo);
        $contactModel->ajouterContact($nom, $email, $message);

        // 🚀 Redirection après succès  // vers une page de remerciement
        header("Location: merci.html");
        exit;
    } else {
        // 🚨 Redirection en cas d'erreur // Sinon, retourne à la page formulaire avec une erreur
        header("Location: form_contact.html?error=1");
        exit;
    }
} else {
    // 🚨 Redirection si l'utilisateur tente d'accéder directement sans POST
    header("Location: form_contact.html");
    exit;
}

ob_end_flush();

//-----------------------------------------------version envoie e-mail------------------------------------------------
/*<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // si tu utilises Composer
// ou require_once 'chemin/vers/PHPMailer.php' si sans Composer

$mail = new PHPMailer(true);

try {
    // Config SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';             // serveur SMTP Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'ton.email@gmail.com';    // Ton email Gmail
    $mail->Password = 'motdepasse_app';         // Un mot de passe d'application Gmail (important)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Expéditeur
    $mail->setFrom('ton.email@gmail.com', 'Garage Vincent Parrot');
    
    // Destinataire : garage
    $mail->addAddress('garage.vincent@example.com');

    // Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = "📩 Nouveau message de contact";
    $mail->Body = "
        <h2>Message depuis le formulaire du site</h2>
        <p><strong>Nom :</strong> {$_POST['nom']}</p>
        <p><strong>Email :</strong> {$_POST['email']}</p>
        <p><strong>Sujet :</strong> {$_POST['sujet']}</p>
        <p><strong>Message :</strong><br>{nl2br(htmlspecialchars($_POST['message']))}</p>
    ";

    // ✅ Accusé de réception à l'utilisateur
    $mail->addReplyTo($_POST['email']);
    $mail->send();

    // Deuxième mail (accusé pour le client)
    $mail->clearAddresses();
    $mail->addAddress($_POST['email']);
    $mail->Subject = "Merci pour votre message – Garage Vincent Parrot";
    $mail->Body = "
        <p>Bonjour {$_POST['nom']},</p>
        <p>Nous avons bien reçu votre message concernant :</p>
        <blockquote>{$_POST['sujet']}</blockquote>
        <p>Notre équipe vous répondra rapidement.</p>
        <p>Bien cordialement,<br>L'équipe du Garage Vincent Parrot</p>
    ";
    $mail->send();

    // Redirection vers la page merci
    header("Location: merci.html");
    exit;
} catch (Exception $e) {
    echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
}*/