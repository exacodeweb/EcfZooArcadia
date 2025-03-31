<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../config/login.php");
    exit;
}

// ✅ Connexion à la base de données
require_once('../../public/utilise.php');  // Vérifie que $pdo est bien défini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];  
    $role = $_POST['role'];

    // Vérification si l'email existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";  
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
        exit;
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($motDePasse, PASSWORD_BCRYPT);

    // Insérer l'utilisateur dans la base de données
    $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, role) 
            VALUES (:prenom, :nom, :email, :mot_de_passe, :role)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $hashedPassword);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo "Utilisateur ajouté avec succès.";
        header("Location: tableau-de-bord.php");  // Redirection après ajout
        echo "Utilisateur ajouté avec succès. <a href='./tableau-de-bord.php'>Aller au tableau de bord</a>"; // ajouter
        exit;
    } else {
        echo "Une erreur est survenue. L'utilisateur n'a pas pu être ajouté.";
    }
}
?>
















<!--?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ./../config/login.php");
    exit;
}

// ✅ Connexion à la base de données
require_once('../../public/utilise.php');  // Assurez-vous que ce fichier définit bien $pdo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];  // ✅ Correction de la clé
    $role = $_POST['role'];

    // Vérification si l'email existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";  // ✅ Correction du nom de la table
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
        exit;
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($motDePasse, PASSWORD_BCRYPT);

    // Insérer l'employé dans la base de données   // ✅ Correction du nom de la table
    $sql = "INSERT INTO utilisateurs (prenom, nom, email, motDePasse, role)
            VALUES (:prenom, :nom, :email, :motDePasse, :role)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':motDePasse', $hashedPassword);  // ✅ Correction du paramètre
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo "Employé ajouté avec succès.";
        header("Location: tableau-de-bord.php");  // Redirection après ajout
        exit;
    } else {
        echo "Une erreur est survenue. L'employé n'a pas pu être ajouté.";
    }
}
?>
-->













<!--?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

require_once('../../config/utilise.php');  // Connexion à la base de données*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];//motDePasse
    $role = $_POST['role'];

    // Vérification si l'email existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";//users2
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
        exit;
    }
 
    // Hachage du mot de passe
    $hashedPassword = password_hash($motDePasse, PASSWORD_BCRYPT);

    // Insérer l'employé dans la base de données
    $sql = "INSERT INTO utilisateurs (prenom, nom, email, motDePasse, role) VALUES (:prenom, :nom, :email, :motDePasse, :role)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $hashedPassword);//motDePasse
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo "Employé ajouté avec succès.";
        header("Location: tableau-de-bord.php");  // Rediriger vers le tableau de bord
        exit;
    } else {
        echo "Une erreur est survenue. L'employé n'a pas pu être ajouté.";
    }
}
?>
-->
<!--
3. Explications détaillées du fichier de traitement :
Sécurité : Avant d'exécuter ce code, on vérifie que l'utilisateur connecté a bien le rôle admin (via $_SESSION['role']).
Préparation de la requête : On prépare une requête SQL pour vérifier si l'email existe déjà dans la base de données. Si c'est le cas, l'employé ne sera pas ajouté.
Hachage du mot de passe : On utilise password_hash() pour sécuriser le mot de passe avant de l'enregistrer.
Insertion des données : Après la validation et le hachage du mot de passe, on insère l'employé dans la table users2 de la base de données.
-->

