<?php
// Toujours en tout début de fichier, sans ligne blanche avant !
session_start();

// Vérification de connexion vétérinaire
if (!isset($_SESSION['veterinaire_id'])) {
    die("Accès refusé. Veuillez vous connecter en tant que vétérinaire.");
}

$veterinaire_id = $_SESSION['veterinaire_id'];

require_once './config_unv.php';

try {
    $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "ZOO_Arcadia!2024", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Récupération des habitats
    $sql = "SELECT id, nom FROM habitats";
    $stmt = $pdo->query($sql);
    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Laisser un avis sur un habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h2 class="text-center">Laisser un avis sur un habitat</h2>
            </div>
            <div class="card-body">
                <form action="traitement_avis_habitat.php" method="POST">
                    <div class="mb-3">
                        <label for="habitat_id" class="form-label">Sélectionnez un habitat :</label>
                        <select name="habitat_id" id="habitat_id" class="form-select" required>
                            <?php foreach ($habitats as $habitat): ?>
                                <option value="<?= htmlspecialchars($habitat['id']) ?>">
                                    <?= htmlspecialchars($habitat['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire :</label>
                        <textarea name="commentaire" id="commentaire" class="form-control" rows="4" required></textarea>
                    </div>

                    <input type="hidden" name="veterinaire_id" value="<?= htmlspecialchars($veterinaire_id) ?>">

                    <button type="submit" class="btn btn-primary w-100">Soumettre l'avis</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>













<!--?php 
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




session_start();
// Démarrer la session pour accéder aux données de l'utilisateur connecté

// Vérifier si le vétérinaire est connecté
if (!isset($_SESSION['veterinaire_id'])) {

    die("Accès refusé. Veuillez vous connecter en tant que vétérinaire.");
}
//$_SESSION['veterinaire_id'] = $veterinaire['id'];
$veterinaire_id = $_SESSION['veterinaire_id']; // Récupérer l'ID du vétérinaire connecté

// Connexion à la base de données
require_once './config_unv.php';

try {
    $pdo = new PDO("mysql:host=db;dbname=zoo_arcadia;charset=utf8mb4", "utilisateur_zoo", "ZOO_Arcadia!2024", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Récupérer la liste des habitats
    $sql = "SELECT id, nom FROM habitats";
    $stmt = $pdo->query($sql);
    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laisser un avis sur un habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h2 class="text-center">Laisser un avis sur un habitat</h2>
            </div>
            <div class="card-body">
                <form action="traitement_avis_habitat.php" method="POST">
                    <div class="mb-3">
                        <label for="habitat" class="form-label">Sélectionnez un habitat :</label>
                        <select name="habitat_id" class="form-select" required>
                            <!?php foreach ($habitats as $habitat): ?>
                                <option value="<!?= htmlspecialchars($habitat['id']); ?>">
                                    <!?= htmlspecialchars($habitat['nom']); ?>
                                </option>
                            <!?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire :</label>
                        <textarea name="commentaire" class="form-control" rows="4" required></textarea>
                    </div>

                    <input type="hidden" name="veterinaire_id" value="<!?= htmlspecialchars($veterinaire_id); ?>">

                    <button type="submit" class="btn btn-primary w-100">Soumettre l'avis</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

                            -->
















<!--?php 
// Vérifier si le vétérinaire est connecté
session_start();
if (!isset($_SESSION['veterinaire_id'])) {
    die("Accès refusé. Veuillez vous connecter en tant que vétérinaire.");

   
}

$veterinaire_id = $_SESSION['veterinaire_id'] ?? null;

if (!$veterinaire_id) {
    die("Vous devez être connecté en tant que vétérinaire.");
}


//$veterinaire_id = $_SESSION['veterinaire_id']; // ID du vétérinaire connecté
$veterinaire_id = $_SESSION['veterinaire_id'] = $veterinaire_id;  // $veterinaire_id est récupéré lors de la connexion
// Connexion à la base de données
require_once './config_unv.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    // Récupérer la liste des habitats
    $sql = "SELECT id, nom FROM habitats";
    $stmt = $pdo->query($sql);
    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laisser un avis sur un habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h2 class="text-center">Laisser un avis sur un habitat</h2>
            </div>
            <div class="card-body">
                <form action="traitement_avis_habitat.php" method="POST">
                    <div class="mb-3">
                        <label for="habitat" class="form-label">Sélectionnez un habitat :</label>
                        <select name="habitat_id" class="form-select" required>
                            <!!?php foreach ($habitats as $habitat): ?>
                                <option value="<!?= htmlspecialchars($habitat['id']); ?>">
                                    <!?= htmlspecialchars($habitat['nom']); ?>
                                </option>
                            <!?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire :</label>
                        <textarea name="commentaire" class="form-control" rows="4" required></textarea>
                    </div>

                    <input type="hidden" name="veterinaire_id" value="<?= htmlspecialchars($veterinaire_id); ?>">

                    <button type="submit" class="btn btn-primary w-100">Soumettre l'avis</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



















<!--?php
// Vérifier si le vétérinaire est connecté (à adapter selon ton système d'authentification)
session_start();
if (!isset($_SESSION['veterinaire_id'])) {
    die("Accès refusé. Veuillez vous connecter en tant que vétérinaire.");
}
$veterinaire_id = $_SESSION['veterinaire_id']; // ID du vétérinaire connecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Laisser un avis sur un habitat</title>
</head>
<body>
    <h2>Laisser un avis sur un habitat</h2>
    <form action="traitement_avis_habitat.php" method="POST">
        <label for="habitat">Sélectionnez un habitat :</label>
        <select name="habitat_id" required>
            <!?php
            // Connexion à la base de données
            require './config.php';
            $sql = "SELECT id, nom FROM habitats";
            $result = $pdo->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['nom']}</option>";
            }
            ?>
        </select>

        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" required></textarea>

        <input type="hidden" name="veterinaire_id" value="<!?= $veterinaire_id; ?>">
        <button type="submit">Soumettre l'avis</button>
    </form>
</body>
</html>