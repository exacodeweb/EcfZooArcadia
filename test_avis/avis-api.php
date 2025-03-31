<?php
require_once './config.php';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare("SELECT message, auteur FROM avis WHERE statut = 'approuve' ORDER BY date_creation DESC LIMIT 20");
  $stmt->execute();
  $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header("Content-Type: application/json");
  echo json_encode($avis);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => "Erreur lors de la récupération des avis."]);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

?><!--//Créez le fichier avis-api.php pour récupérer les avis validés depuis la base de données :-->
<?php
header('Content-Type: application/json');

// Exemple d'avis
$avis = [
  ["id" => 1, "auteur" => "Alice", "message" => "Service impeccable !", "rating" => 4],
  ["id" => 2, "auteur" => "Bob", "message" => "Très satisfait, je recommande.", "rating" => 5],
  ["id" => 3, "auteur" => "Claire", "message" => "Rapide et efficace !", "rating" => 4]
];

// Envoi de la réponse JSON
echo json_encode($avis);

// Test
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>