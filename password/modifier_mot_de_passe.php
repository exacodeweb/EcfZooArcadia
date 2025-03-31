<?php 
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}
/*
require './database.php';//database_parrot.php

// Traitement du formulaire de changement de mot de passe pour un utilisateur sélectionné
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $nouveau_mdp = trim($_POST['nouveau_mdp']);
    $confirmation_mdp = trim($_POST['confirmation_mdp']);

    if ($nouveau_mdp !== $confirmation_mdp) {
        $message = "Les nouveaux mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($nouveau_mdp, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");//users2
        $stmt->execute([
            ':password' => $hashed_password,
            ':id' => $user_id
        ]);
        $message = "Mot de passe mis à jour avec succès pour l'utilisateur sélectionné.";
    }
}

// Récupérer la liste des utilisateurs concernés (employés et vétérinaires)
$stmt = $pdo->query("SELECT id, email, user_type FROM utilisateurs WHERE role IN ('employe', 'veterinaire')");//users2 //user_type //employee  //veterinarian
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);  */
?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mot de passe utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center text-gray-700">Modifier le mot de passe d'un utilisateur</h1>

        <!-- Affichage du message de résultat -->
        <?php if (isset($message)): ?>
            <p class="text-center text-gray-700 mb-4"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
            <div class="relative">
                <label for="user_id" class="block text-gray-700">Sélectionnez un utilisateur :</label>
                <select name="user_id" id="user_id" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo htmlspecialchars($user['id']); ?>">
                            <?php echo htmlspecialchars($user['email']) . " (" . htmlspecialchars($user['role']) . ")"; ?> <!-- user_type -->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="relative">
                <label for="nouveau_mdp" class="block text-gray-700">Nouveau mot de passe :</label>
                <input type="password" name="nouveau_mdp" id="nouveau_mdp" required
                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="relative">
                <label for="confirmation_mdp" class="block text-gray-700">Confirmez le nouveau mot de passe :</label>
                <input type="password" name="confirmation_mdp" id="confirmation_mdp" required
                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition">
                Mettre à jour
            </button>
        </form>
    </div>
</body>
</html>