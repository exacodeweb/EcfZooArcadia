<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Administrateur</title>
  <!--<link rel="stylesheet" href="x../admin-0/login_style.css">-->
  <link rel="stylesheet" href="">
  <style>
    /* Vos styles ici */
  </style>

<style>
  body {
    background-position: 100% 100%;
    margin: 0;
    font-size: 1em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  body {
    background-position: 100% 100%;
    margin: 0;
    font-size: 1em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0px;
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

  /*.link-item*/
  .link-rep {
    margin: 0 5px;
  }

  .content {
    display: flex;
    flex-direction: column;
    width: 90%;
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

  /* TITRE ACCEUIL */
  h1 {
    color: #0000ff;
    color: #d94350;
    font-weight: 600;
    /* font-size: 2.5em;*/
  }

  h2 {
    color: #0000ff;
    font-weight: 600;
    font-size: 1.5em;
    margin-top: 0;
  }

  .title-admin {
    text-align: center;
    font-size: 3.5em;
    width: 100%;
    height: auto;
    font-family: "Tangerine", serif;
    text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.4);
    margin: 15px 0;
  }

  /* */
  .form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    /*30%*/
    border: 1px solid grey;
    border-radius: 5px;
    background-color: #f8f9f8;
    padding: 10px;
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

  label {
    font-weight: bold;
    margin-bottom: 10px;
    width: 100%;
  }

  input,
  select {
    height: 25px;
    text-align: left;
    width: 100%;
    margin-bottom: 10px;
  }

  .button {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-top: 15px;
    padding: 10px;
    margin-bottom: 20px;
    width: 160px;
    height: 30px;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
    background: mediumorchid;
    color: white;
    border: none;
  }

  .button:hover {
    background: rgb(211, 85, 163);
  }

  @media screen and (max-width: 576px) {
    .form {
      width: 100%;
    }

    .form-control {
      width: 100%;
    }

    input,
    select {
      width: 100%;
    }
  }

  /* Responsive Design */
  @media screen and (max-width: 576px) {
    .content {
      width: 100%;
      padding: 5px;
    }

    .main {
      width: 90%;
      border: 1px solid red;
      padding: 20px;
    }

    .article {
      width: 100%;
    }

    .form {
      width: 100%;
    }

    .form-control {
      width: 100%;
    }

    input {
      width: 100%;
    }
  }
</style>

</head>

<body>

  <!-- breadcrumb items -->
  <div class="breadcrumb-item">
    <!-- <a href="../index.html" class="link-rep">Accueil</a> /-->
    <!--<a href="../index.html" class="link-rep">Accueil</a> / Connexion Tableau de Bord-->
    <a href="../index.php" class="link-rep">Accueil</a> / Connexion Tableau de Bord
  </div>

  <div class="login-container">

    <h2>Connexion Administrateur</h2>

    <!--<form method="POST" action="login.php">-->
    <form method="$_POST" action="admin-2login.php">
      <label for="email">Adresse e-mail:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Mot de passe:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Connexion</button>
    </form>
    
  </div>

</body>
</html>
