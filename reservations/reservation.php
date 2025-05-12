<?php 
// Connexion à la base de données
$pdo = new PDO('mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4', 'utilisateur_zoo', 'Z00_Arcadia!2024');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des types de visite depuis la base
$typesVisite = $pdo->query("SELECT * FROM types_visite")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réserver une visite - Zoo Arcadia</title>
  <link rel="stylesheet" href="styles.css"> <!-- lien vers le CSS externe -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f2f6fa;
  color: #333;
  display: flex;
  justify-content: center;
  padding: 40px 20px;
}

/* Container */
.form-container {
  background-color: white;
  padding: 30px;
  border-radius: 12px;
  max-width: 600px;
  width: 100%;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 25px;
  color: #2a6f97;
}

/* Form */
.form-zoo {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: 600;
  margin-bottom: 6px;
}

input,
select {
  padding: 10px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 8px;
  transition: border-color 0.3s ease;
}

input:focus,
select:focus {
  border-color: #2a6f97;
  outline: none;
}

/* Button */
.btn-submit {
  background-color: #2a6f97;/* *//* #2A7E50*/
  color: white;
  font-size: 16px;
  padding: 12px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #1e567a;
}

/* Responsive */
@media (max-width: 500px) {
  h1 {
    font-size: 22px;
  }

  .btn-submit {
    font-size: 15px;
    padding: 10px;
  }

  input,
  select {
    font-size: 14px;
  }
}
</style>
</head>
<body>
  <section class="form-container">
    <h1>Réservation de billets</h1>

    <form action="traitement_reservation.php" method="POST" class="form-zoo">
      <div class="form-group">
        <label for="nom">Nom complet :</label>
        <input type="text" id="nom" name="nom_visiteur" required>
      </div>

      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="date">Date de visite :</label>
        <input type="date" id="date" name="date_visite" required>
      </div>

      <div class="form-group">
        <label for="service_id">Type de visite :</label><!-- type_visite-->
        <select id="service_id" name="service_id" required><!-- type_visite -->
          <?php foreach ($typesVisite as $type): ?>
            <option value="<?= htmlspecialchars($type['id']) ?>"><!--nom_type  -->
              <?= htmlspecialchars($type['nom_type']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="nb_adultes">Nombre d'adultes :</label>
        <input type="number" id="nb_adultes" name="nb_adultes" min="0" value="1" required>
      </div>

      <div class="form-group">
        <label for="nb_enfants">Nombre d'enfants :</label>
        <input type="number" id="nb_enfants" name="nb_enfants" min="0" value="0">
      </div>

      <div class="form-group">
        <label for="nb_etudiants">Nombre d'étudiants :</label>
        <input type="number" id="nb_etudiants" name="nb_etudiants" min="0" value="0">
      </div>

      <button type="submit" class="btn-submit">Réserver</button>
    </form>
  </section>
</body>
</html>














<!--?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4', 'utilisateur_zoo', 'Z00_Arcadia!2024');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des types de visite depuis la base
$typesVisite = $pdo->query("SELECT * FROM types_visite")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réserver une visite - Zoo Arcadia</title>

  <style>
  /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f2f6fa;
  color: #333;
  display: flex;
  justify-content: center;
  padding: 40px 20px;
}

/* Container */
.form-container {
  background-color: white;
  padding: 30px;
  border-radius: 12px;
  max-width: 600px;
  width: 100%;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 25px;
  color: #2a6f97;
}

/* Form */
.form-zoo {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-weight: 600;
  margin-bottom: 6px;
}

input,
select {
  padding: 10px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 8px;
  transition: border-color 0.3s ease;
}

input:focus,
select:focus {
  border-color: #2a6f97;
  outline: none;
}

/* Button */
.btn-submit {
  background-color: #2a6f97;
  color: white;
  font-size: 16px;
  padding: 12px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #1e567a;
}

/* Responsive */
@media (max-width: 500px) {
  h1 {
    font-size: 22px;
  }

  .btn-submit {
    font-size: 15px;
    padding: 10px;
  }

  input,
  select {
    font-size: 14px;
  }
}
</style>
</head>
<body>
  <h1>Réservation de billets</h1>

  <form action="traitement_reservation.php" method="POST">
    <label>Nom complet :</label><br>
    <input type="text" name="nom_visiteur" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Date de visite :</label><br>
    <input type="date" name="date_visite" required><br><br>

    <label>Type de visite :</label><br>
    <select name="type_visite" required>
      <!?php foreach ($typesVisite as $type): ?>
        <option value="<!?= htmlspecialchars($type['nom_type']) ?>">
          <!?= htmlspecialchars($type['nom_type']) ?>
        </option>
      <!?php endforeach; ?>
    </select><br><br>

    <label>Nombre d'adultes :</label><br>
    <input type="number" name="nb_adultes" min="0" value="1" required><br><br>

    <label>Nombre d'enfants :</label><br>
    <input type="number" name="nb_enfants" min="0" value="0"><br><br>

    <label>Nombre d'étudiants :</label><br>
    <input type="number" name="nb_etudiants" min="0" value="0"><br><br>

    <button type="submit">Réserver</button>
  </form>
</body>
</html>
