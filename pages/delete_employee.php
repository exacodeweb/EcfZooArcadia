<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supprimer Employé</title>

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
      width: 40%;
      /*30%*/
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
      /*100%*/
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
      width: 200px;
      /*150px*/
      /*160px*/
      border-radius: 50px;
      text-decoration: none !important;
      background-color: mediumorchid !important;
      /*#0145b5*/
      color: white;
    }

    .link-btn:hover {
      background-color: rgb(211, 85, 163) !important;
      /*green*/
    }
  </style>

</head>

<body>

  <div class="content">
    <main class="main">

      <!-- breadcrumb items -->
      <div class="breadcrumb-item">
        <!-- <a href="../index.html" class="link-rep">Accueil</a> /-->
        <a href="../admin-2/admin_dashboard.php" class="link-rep">Administrateur</a> / Suprimer comptes
      </div>

      <h1>Supprimer Employé</h1>
      <form method="POST" action="remove_employee.php">
        <label for="id">ID Employé :</label>
        <input type="text" id="id" name="id" required>
        <button type="submit">Supprimer</button>
      </form>

    </main>
  </div>

</body>

</html>

<!-------------------------------------------->
<!-- formulaire pour supprimer un employé : -->
<!-------------------------------------------->