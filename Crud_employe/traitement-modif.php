<?php // mettre à jour l’employé dans la base.
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

//require_once('../public/utilise.php'); // Connexion à la BDD
require_once '../config/config_unv.php'; // a testé

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);


    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $role = htmlspecialchars($_POST['role']);

    if (!$email) {
        die("Email invalide !");
    }

    // Vérifier si l'email est déjà utilisé par un autre utilisateur
    $sql_check = "SELECT id FROM utilisateurs WHERE email = ? AND id != ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$email, $id]);
    if ($stmt_check->fetch()) {
        die("Cet email est déjà utilisé !");
    }

    // Mettre à jour l'employé
    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $prenom, $email, $role, $id])) {
        header("Location: liste.php");
        exit;
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>