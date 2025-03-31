<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

try {
  // Connexion à la base de données
  $pdo = new PDO(                                              //database
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

      $success = "Mot de passe mis à jour avec succès.";
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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .login-card {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      background-color: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-card h1 {
      font-size: 1.75rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .login-card label {
      font-weight: bold;
    }

    .login-card .form-control {
      margin-bottom: 1rem;
      font-size: 1rem;
    }

    .login-card button {
      font-size: 1rem;
      padding: 0.75rem;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-card">
      <h1>Connexion</h1>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="email" class="form-label">Email :</label> <!-- admin@example.com -->
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe :</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
      </form>
    </div>
  </div>
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


// Inclure le fichier de configuration
//$config = include('../config/config.php');  pause
//-------------------------$config = include('../config/config.php');
// Démarrer une session
//-------------------------session_start();
