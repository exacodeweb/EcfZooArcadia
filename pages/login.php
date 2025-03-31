<?php 
$config = include('../config/config-unv.php');
session_start();

try {
    $pdo = new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
        $config['db']['username'],
        $config['db']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //cré&tion de la session pour chaque utilisateur
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nom'] = $user['nom'];

            switch ($user['role']) {
                case 'admin':
                    header("Location: ../pages/admin_dashboard.php");
                    break;
                case 'employe':
                    header("Location: ../pages/employe_dashboard.php");
                    break;
                case 'veterinaire':
                    header("Location: ../pages/veterinaire_dashboard.php");
                    break;
            }
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
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
    <link rel="stylesheet" href="styles.css"> <!-- Fichier CSS externe -->
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Se connecter</button>
    </form>

    <!--<p class="forgot-password"><a href="password-reset.php">Mot de passe oublié ?</a></p>-->
</div>

</body>
</html>












<!--?php
//var_dump($config);
//exit;
//require_once __DIR__ . '/../config/config_unv.php';
//require_once '../config/config_unv.php'; // a testé
// Inclure le fichier de configuration
$config = include('../config/config.php');

// Démarrer une session
session_start();

try {
  // Connexion à la base de données
  $pdo = new PDO(                                            //database
    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
    $config['db']['username'],
    $config['db']['password']
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Rechercher l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
      // Stocker les informations de l'utilisateur dans la session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['nom'] = $user['nom'];

      // Rediriger en fonction du rôle
      switch ($user['role']) {
        case 'admin':
          header("Location: ../pages/admin_dashboard.php");
          break;
        case 'employe':
          header("Location: ../pages/employe_dashboard.php");
          break;
        case 'veterinaire':
          header("Location: ../pages/veterinaire_dashboard.php");
          break;
      }
      exit;
    } else {
      $error = "Email ou mot de passe incorrect.";
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

  <style>
  /* Style global */
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Conteneur du formulaire */
.login-container {
    background: white;
    padding: 20px;
    width: 320px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

/* Titre */
h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Messages d'erreur */
.error-message {
    background: #ffdddd;
    color: #d9534f;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}

/* Champs du formulaire */
form {
    display: flex;
    flex-direction: column;
}

label {
    text-align: left;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Bouton */
button {
    background: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Lien "Mot de passe oublié" */
.forgot-password {
    margin-top: 10px;
}

.forgot-password a {
    color: #007bff;
    text-decoration: none;
}

.forgot-password a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 400px) {
    .login-container {
        width: 90%;
    }
}
</style>

</head>

<body>
  <h1>Connexion</h1>

  <!?php
  if (!isset($config) || !is_array($config)) {
    die('Erreur : Configuration de la base de données non définie.');
  }
  ?>
  <!?php if (!empty($error)): ?>
    <p style="color: red;"><!?php echo $error; ?></p>
  <!?php endif; ?>
  <form method="POST" action="">
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Se connecter</button>
  </form>
</body>

</html>  -->



<!--?php
$config = include('../config/config.php');
session_start();

try {
  $pdo = new PDO(
    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
    $config['db']['username'],
    $config['db']['password']
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['nom'] = $user['nom'];

      switch ($user['role']) {
        case 'admin':
          header("Location: ../pages/admin_dashboard.php");
          break;
        case 'employe':
          header("Location: ../pages/employe_dashboard.php");
          break;
        case 'veterinaire':
          header("Location: ../pages/veterinaire_dashboard.php");
          break;
      }
      exit;
    } else {
      $error = "Email ou mot de passe incorrect.";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-lg">
          <div class="card-body"> -------------------------->
            <!--<h2 class="text-center mb-4">Connexion</h2>-->  <!-------------------------
            <h2 class="text-center mb-1">Modifier mon mot de passe</h2>

            <!?php if (!empty($error)) : ?>
              <div class="alert alert-danger text-center"><!?= htmlspecialchars($error) ?></div>
            <!?php endif; ?>

            <form method="POST" action="">
              <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>

            <p class="mt-3 text-center"> --------------------->
              <!--<a href="password-reset.php">Mot de passe oublié ?</a>--> <!-----------------------
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->












