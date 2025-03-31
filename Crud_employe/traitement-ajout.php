<?php // insérer les données dans la base.
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

//require_once('../public/utilise.php'); // Connexion à la BDD
//require_once('../config/config-test.php');
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
?>