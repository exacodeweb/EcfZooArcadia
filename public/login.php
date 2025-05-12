<?php
// Inclure le fichier de configuration centralisé
require_once '../config/config_unv.php';

// Démarrer une session sécurisée
session_start();
if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Générer un token CSRF unique
}

try {
  // Initialiser le message d'erreur 
  $error = "";

  // Gestion des tentatives de connexion (protection contre la force brute)
  if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = 0;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die("Erreur CSRF détectée !");
    }

    // Vérifier si trop de tentatives récentes
    if ($_SESSION['login_attempts'] >= 5 && (time() - $_SESSION['last_attempt_time']) < 900) { // 15 minutes de blocage
      $error = "Trop de tentatives de connexion. Réessayez plus tard.";
    } else {
      $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
      $password = trim($_POST['password']);

      // Rechercher l'utilisateur dans la base de données
      $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
      $stmt->execute([$email]);
      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Réinitialiser les tentatives de connexion en cas de succès
        $_SESSION['login_attempts'] = 0;

        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = htmlspecialchars($user['nom'], ENT_QUOTES, 'UTF-8');

        // Redirection sécurisée
        $redirectPages = [
          'admin' => '../pages/admin_dashboard.php',
          'employe' => '../pages/employe_dashboard.php',
          'veterinaire' => '../pages/veterinaire_dashboard.php'
        ];

        header("Location: " . ($redirectPages[$user['role']] ?? '../index.php'));
        exit;
      } else {
        $error = "Email ou mot de passe incorrect.";
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
      }
    }
  }
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="./styles-login.css">
</head>
<body>
  <form method="POST" action="">
    <h1>Connexion</h1>
    <?php if (!empty($error)): ?>
      <p class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" placeholder="Entrez votre email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>

    <button type="submit">Se connecter</button>
  </form>
</body>
</html>
