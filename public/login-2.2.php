<?php
// Inclure le fichier de configuration
$config = include('../config/config.php'); //../config/config.php
//require_once '../config/config_unv.php';

// Démarrer une session sécurisée
session_start();
if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Générer un token CSRF unique
}

try {
  // Connexion à la base de données
  $pdo = new PDO(                                              //database
    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
    $config['db']['username'],
    $config['db']['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );

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
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

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

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

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

<!--<style>
/* Style de base pour le corps */
body {
  font-family: 'Arial', sans-serif;
  background-color: #f3f4f6;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* Conteneur principal */
form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
  box-sizing: border-box;
}

/* Titre */
h1 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
}

/* Champs de formulaire */
label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
  color: #555;
  text-align: left;
}

/* Style commun pour input et textarea */
input, textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  background-color: #f9f9f9;
  transition: border-color 0.3s, box-shadow 0.3s;
  box-sizing: border-box;
}

/* Ajout pour textarea */
textarea {
  resize: vertical; /* Permet de redimensionner verticalement uniquement */
}

/* Effet de focus */
input:focus, textarea:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Bouton */
button {
  background-color: #007bff;
  color: #fff;
  font-size: 16px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
  width: 100%;
  box-sizing: border-box;
}

button:hover {
  background-color: #0056b3;
  transform: scale(1.02);
}

/* Message d'erreur */
.error-message {
  color: red;
  margin-bottom: 15px;
  font-size: 14px;
  text-align: center;
}

/* Responsive Design */
@media (max-width: 600px) {
  body {
    padding: 10px;
  }
  form {
    padding: 15px;
  }
  button {
    font-size: 14px;
    padding: 8px;
  }
}

</style>-->