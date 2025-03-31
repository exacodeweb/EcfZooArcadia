<?php 
//require '../service_veterinaire/db.php';
require_once '../config/config_unv.php'; /*employe@example.com*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $new_password = trim($_POST['new_password']);
  $confirm_password = trim($_POST['confirm_password']); 

  if ($new_password !== $confirm_password) {
    $error = "Les nouveaux mots de passe ne correspondent pas.";
  } else {
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    //$stmt = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");
    $stmt = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = :password WHERE id = :id");
    if($stmt->execute([
      ':password' => $hashed_password,
      ':id' => $user_id
    ])){
      $success = "Mot de passe mis à jour avec succès.";
    } else {
      $error = "Erreur lors de la mise à jour du mot de passe.";
    }
  }
}

$users = $pdo->query("SELECT id, email, role FROM utilisateurs WHERE role IN ('employe', 'veterinaire')")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gérer les mots de passe des utilisateurs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- tailwind CSS Test --> 
  <!--<script src="https://cdn.tailwindcss.com"></script>-->

  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .breadcrumb-item a {
      text-decoration: none;
      color: #007bff;
    }
    .breadcrumb-item a:hover {
      text-decoration: underline;  
    }
    .container {
      width: 40%;
    }
    @media (max-width: 576px) {
      .container {
        width: 100%;
      }
    }

  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div       class="container my-5"       class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md"  >
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../pages/admin_dashboard.php">Administrateur</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gérer mots de passe utilisateur</li>
      </ol>
    </nav>
    
    <h2 class="text-center mb-4  text-primary" >Gérer les mots de passe des employés et vétérinaires</h2>
    <!--<h3 class="text-center text-gray-600 mb-4">Vous modifiez le mot de passe : <!-?php echo $_SESSION['nom']; ?> (Administrateur)</h3>-->

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <div class="card shadow-sm"    >
      <div class="card-body"   class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md"      >
        <form method="post"   class="space-y-4">
          <div class="mb-3">
            <label for="user_id" class="form-label  text-primary">Sélectionner un utilisateur :</label>
            <select id="user_id" name="user_id" class="form-select" required>
              <?php foreach ($users as $user): ?>
                <option value="<?= htmlspecialchars($user['id']) ?>">
                  <?= htmlspecialchars($user['email']) . " (" . htmlspecialchars($user['role']) . ")" ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3"    class="relative">
            <label for="new_password" class="form-label  text-primary">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
          </div>
          <div class="mb-3"    class="relative">
            <label for="confirm_password" class="form-label  text-primary">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100 ">Changer le mot de passe</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle --> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!--?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}
?>-->








<!--?php 
//session_start();
//if ($_SESSION['user_type'] !== 'admin') {
  //header('Location: ../config/login.php');
  //exit();
//}--> <!--

//require '../password/database.php';// database_parrot.php
//require '../config/config.php';
require '../service_veterinaire/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $new_password = trim($_POST['new_password']);
  $confirm_password = trim($_POST['confirm_password']);

  if ($new_password !== $confirm_password) {
    echo "Les nouveaux mots de passe ne correspondent pas.";
  } else {
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");//users2
    $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $user_id
    ]);
    echo "Mot de passe mis à jour avec succès.";
  }
}

// Récupérer les employés et vétérinaires de la table users2  employee veterinarian
$users = $pdo->query("SELECT id, email, role FROM utilisateurs WHERE role IN ('employe', 'veterinaire')")->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gérer les mots de passe des utilisateurs</title>
</head>

<body>
  <div class="content">
    <main class="main">
      <div class="breadcrumb-item"> --> <!-- ../admin-2/admin_dashboard.php --> <!--
        <a href="../pages/admin_dashboard.php" class="link-rep">Administrateur</a> / Gérer mots de passe utilisateur
      </div>

      <h2>Gérer les mots de passe des employés et vétérinaires</h2>
      <form method="post">
        <label for="user_id">Sélectionner un utilisateur :</label>
        <select id="user_id" name="user_id">
          <!?php foreach ($users as $user): ?>
            <option value="<!?php echo htmlspecialchars($user['id']); ?>">
              <!?php echo htmlspecialchars($user['email']) . " (" . htmlspecialchars($user['role']) . ")"; ?>
            </option>
          <!?php endforeach; ?>
        </select>
        <br>
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>
        <label for="confirm_password">Confirmer le mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Changer le mot de passe</button>
      </form>
    </main>
  </div>
</body>
</html>