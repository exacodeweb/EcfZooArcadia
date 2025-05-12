<?php
//include 'config.php';
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["prenom"];
    $race = $_POST["race"];
    $images = json_encode(explode(',', $_POST["images"]));
    $habitat_id = $_POST["habitat_id"];

    $stmt = $pdo->prepare("INSERT INTO animaux (prenom, race, images, habitat_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$prenom, $race, $images, $habitat_id])) {
        echo "Animal ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout.";
    }
}
?>

<form method="post">
    <label>Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label>Espèce :</label><!-- Race -->
    <input type="text" name="race" required><br>

    <label>Images :</label>
    <input type="text" name="images" required><br>

    <label>Habitat :</label>
    <input type="number" name="habitat_id" required><br>

    <button type="submit">Ajouter Animal</button>
</form>
