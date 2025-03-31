<?php
session_start();
if ($_SESSION['user_type'] !== 'admin') {
  header('Location: login_parrot.php');
  exit();
}

require 'database_parrot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $employee_id = $_POST['employee_id'];
  $new_password = trim($_POST['new_password']);
  $confirm_password = trim($_POST['confirm_password']);

  if ($new_password !== $confirm_password) {
    echo "Les nouveaux mots de passe ne correspondent pas.";
  } else {
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE users2 SET password = :password WHERE id = :id");
    $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $employee_id
    ]);
    echo "Mot de passe de l'employé mis à jour avec succès.";
  }
}

// Récupérer les employés de la table users2
$employees = $pdo->query("SELECT id, email FROM users2 WHERE user_type = 'employee'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gérer les mots de passe des employés</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .content {
      display: flex;
      flex-direction: column;
      width: 100%;
      margin: 20px 0;
      justify-content: center;
      align-items: center;
    }

    .main {
      flex-direction: column;
      width: 100%;
      background: #fbfbf9;
      align-items: center;
      border-radius: 5px;
      box-shadow: 0 0 40px rgba(128, 128, 128, 0.2);
      display: flex;
      justify-content: center;
      align-content: center;
    }

    .breadcrumb-item {
      width: 100%;
      background: none;
      margin: 10px;
      float: left;
      flex-direction: row;
      justify-content: center;
      align-content: center;
      padding: 0;
    }

    .link-item {
      margin: 0 5px;
    }

    /*
    .breadcrumb-item {
      margin: 0 5px;
    }
    */

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 40%;
      border: 1px solid grey;
      border-radius: 5px;
      background-color: #f8f9f8;
      padding: 10px;
      margin-bottom: 50px;
    }

    .section-form {
      display: flex;
      flex-direction: column;
      width: 30%;
      height: auto;
      justify-content: center;
      align-items: center;
      padding: 10px;
    }

    .form-control {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 10px;
      width: 80%;
      background-color: #f8f9f8;
      height: auto;
      border: none;
    }

    form label {
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input[type="text"],
    form textarea {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    form button {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      font-size: 16px;
    }

    form button:hover {
      background-color: #45a049;
    }

    p.success {
      color: #4CAF50;
    }

    p.error {
      color: #f44336;
    }

    .btn-card {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: auto;
      width: 100%;
      margin-bottom: 10px;
      padding: 20px;
    }

    .link-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 30px;
      width: 200px;
      border-radius: 50px;
      text-decoration: none !important;
      background-color: mediumorchid !important;
      color: white;
    }

    .link-btn:hover {
      background-color: rgb(211, 85, 163) !important;
    }
  </style>
</head>

<body>

  <div class="content">
    <main class="main">

      <!-- breadcrumb items -->
      <div class="breadcrumb-item">
        <!--<a href="../index.html" class="link-rep">Accueil</a> /-->
        <a href="../admin-2/admin_dashboard.php" class="link-rep">Administrateur</a> / Gérer mots de passe employé
      </div>

      <h2>Gérer les mots de passe des employés</h2>
      <form method="post">
        <label for="employee_id">Sélectionner un employé :</label>
        <select id="employee_id" name="employee_id">
          <?php foreach ($employees as $employee): ?>
            <option value="<?php echo htmlspecialchars($employee['id']); ?>">
              <?php echo htmlspecialchars($employee['email']); ?>
            </option>
          <?php endforeach; ?>
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













<!--?php
session_start();
if ($_SESSION['user_type'] !== 'admin') {
    header('Location: login_parrot.php');
    exit();
}

//require 'database.php';//../config/database.php
require 'database_parrot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($new_password !== $confirm_password) {
        echo "Les nouveaux mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users2 SET password = :password WHERE id = :id");//users
        $stmt->execute([
            ':password' => $hashed_password,
            ':id' => $employee_id
        ]);
        echo "Mot de passe de l'employé mis à jour avec succès.";
    }
}

$employees = $pdo->query("SELECT id, username FROM users2 WHERE user_type = 'employee'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les mots de passe des employés</title>  --> <!-- Gérer les mots de passe des employés -->

<!--
    <style>
      /* Style général pour le corps de la page */
      body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 0;
      }

      /* Conteneur principal */
      /*.container {
          width: 80%;
          margin: 20px auto;
          padding: 20px;
          background-color: #fff;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          border-radius: 8px;
      }*/

      .content {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin: 20px 0;
            justify-content: center;
            align-items: center;
        }
.main {
    flex-direction: column;
    width: 100%;
    background: #fbfbf9;
    align-items: center;
    border-radius: 5px;
    box-shadow: 0 0 40px rgba(128, 128, 128, 0.2);
    display: flex;
    justify-content: center;
    align-content: center;


} 

      /* Style pour le formulaire */
      /*form {
          display: flex;
          flex-direction: column;
      }*/

/*------------------------*/

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 40%;/*30%*/
    border: 1px solid grey;
    border-radius: 5px;
    background-color: #f8f9f8;
    padding: 10px;

        margin-bottom: 50px;
}

.section-form {
  display: flex;
  flex-direction: column;
  width: 30%;/*100%*/
  height: auto;
  justify-content: center;
  align-items: center;
  padding: 10px;
}

.form-control {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    width: 80%;
    background-color: #f8f9f8;
    height: auto;
    border: none;
}

/*-----------------------*/

      form label {
          margin-bottom: 5px;
          font-weight: bold;
      }

      form input[type="text"],
      form textarea {
          padding: 10px;
          margin-bottom: 10px;
          border: 1px solid #ddd;
          border-radius: 4px;
      }

      form button {
          padding: 10px 15px;
          border: none;
          border-radius: 4px;
          background-color: #4CAF50;
          color: #fff;
          cursor: pointer;
          font-size: 16px;
      }

      form button:hover {
          background-color: #45a049;
      }

      /* Style pour les messages de succès et d'erreur */
      p.success {
          color: #4CAF50;
      }

      p.error {
          color: #f44336;
      }

        /*Bouton retour blog*/
        .btn-card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: auto;
        width: 100%;
        margin-bottom: 10px;
        padding: 20px;
      }

      .link-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 30px;
        width: 200px; /*150px*//*160px*/
        border-radius: 50px;
        text-decoration: none !important;
        background-color:mediumorchid!important;/*#0145b5*/ 
        color: white;
      }

      .link-btn:hover {
        background-color:rgb(211, 85, 163)!important;/*green*/
      }
    </style>

</head>
<body>

<div class="content">
<main class="main">

    <h2>Gérer les mots de passe de vos respectable employés ée</h2>  --> <!-- Gérer les mots de passe des employés -->
<!--<form method="post">
        <label for="employee_id">Sélectionner un employé :</label>
        <select id="employee_id" name="employee_id">
            <!-?php foreach ($employees as $employee): ?>
                <option value="<!-?php echo htmlspecialchars($employee['id']); ?>">  --> <!--?php echo htmlspecialchars($employee['username']); ?></option>
            <!-?php endforeach; ?>
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