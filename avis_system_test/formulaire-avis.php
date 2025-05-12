<?php
session_start();

// Génération du token CSRF
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Soumettre un Avis</title>
  <link rel="stylesheet" href="styles.css">

  <style>
    /* Style de base pour le corps */
    body {
      font-family: 'Arial', sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    /* Section du formulaire */
    #form-avis {
      max-width: 500px;
      width: 90%;
      /* Pour s'adapter aux écrans étroits */
      margin: 20px;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #form-avis h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #444;
      font-weight: 600;
      text-align: center;
    }

    /* Style du formulaire */
    .avis-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .avis-form label {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 5px;
      color: #555;
    }

    .avis-form input,
    .avis-form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      background-color: #f7f7f7;
      transition: border-color 0.3s ease-in-out;
      box-sizing: border-box;
    }

    .avis-form input:focus,
    .avis-form textarea:focus {
      border-color:  #007bff;
      outline: none;
    }

    /* Bouton */
    .btn {
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .mt-3 {
      margin-top: 20px;
    }
    </style>

    <style>
    /* Responsive */
    @media (max-width: 768px) {
      #form-avis {
        padding: 15px;
      }

      .btn {
        font-size: 14px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>

<section id="form-avis">
  <h2>Laisser un Avis</h2>
  <form action="soumetre-avis.php" method="POST" class="avis-form" novalidate>

    <!-- Pseudo -->
    <div>
      <label for="auteur">Votre Pseudo :</label>
      <!--<input type="text" id="auteur" name="auteur" required>-->
      <input type="text" id="auteur" name="auteur" required maxlength="100">
    </div>

    <!-- Message -->
    <div>
      <label for="message">Votre Avis :</label>
      <!--<textarea id="message" name="message" rows="4" required></textarea>-->
      <textarea id="message" name="message" rows="4" required maxlength="1000"></textarea>
    </div>

    <!-- Honeypot -->
    <div style="display: none;">
      <label for="website">Ne remplissez pas ce champ :</label>
      <input type="text" id="website" name="website">
    </div>

    <!-- CSRF token -->
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

    <!-- Bouton -->
    <button type="submit" class="btn mt-3">Envoyer</button>

  </form>
</section>

<script src="./validation-form.js"></script>
</body>
</html>

















<!--?php
/*session_start();
// CSRF token
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}*/

// CAPTCHA
$captcha_code = rand(1000, 9999);
$_SESSION['captcha'] = $captcha_code;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Laisser un Avis</title>
  <link rel="stylesheet" href="styles.css"> -------------------------->


<!--<style>
  /* Styles de base */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Section du formulaire */
#form-avis {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 100%;
    max-width: 600px;
    margin: 20px;
}

h2 {
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    color: #343a40;
    margin-bottom: 20px;
}

/* Formulaire */
.avis-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    color: #495057;
    margin-bottom: 5px;
}

input, textarea {
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ced4da;
    font-size: 16px;
    color: #495057;
    transition: border 0.3s ease;
}

input:focus, textarea:focus {
    border-color: #007bff;
    outline: none;
}

/* Bouton */
.btn {
    background-color: #007bff;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

.btn:hover {
    background-color: #0056b3;
}

/* Message d'erreur ou de succès (si besoin) */
.message {
    text-align: center;
    color: red;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    #form-avis {
        padding: 20px;
    }

    h2 {
        font-size: 22px;
    }

    .btn {
        padding: 10px;
        font-size: 14px;
    }

    input, textarea {
        font-size: 14px;
    }
}
</style>-->
<!-----------------------
</head>
<body>
  <section id="form-avis">
    <h2>Laisser un Avis</h2>
    <form action="./soumetre-avis.php" method="POST" class="avis-form" novalidate> ---------------> <!-- ./soumetre-avis.php -->
      <!-- Champ Auteur -->  <!------------------------
      <div>
        <label for="auteur">Votre Pseudo :</label>
        <input type="text" id="auteur" name="auteur" required>
      </div> --------------------->

      <!-- Champ Message --> <!------------------
      <div>
        <label for="message">Votre Avis :</label>
        <textarea id="message" name="message" rows="4" required></textarea>
      </div> ----------------------->

      <!-- CSRF token --> <!---------------------
      <input type="hidden" name="csrf_token" value="<!?= $_SESSION['csrf_token']; ?>"> --------------->

      <!-- CAPTCHA --> <!---------------------
      <div>
        <label for="captcha">Recopiez ce code : <strong><!?= $captcha_code ?></strong></label>
        <input type="text" id="captcha" name="captcha" required>
      </div>

      <button type="submit" class="btn mt-3">Envoyer</button>
    </form>
  </section>
</body>
</html>
