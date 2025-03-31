<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Supposons que le nom de l'animal est passé via GET
$animalName = $_GET['animal'] ?? null;

if ($animalName) {
    // Incrémente la clé correspondant à l'animal
    $redis->incr("animal:{$animalName}:consultations");
    echo "Le compteur pour {$animalName} a été incrémenté.";
} else {
    echo "Aucun animal spécifié.";
}
?>



<?php
// nosql/redis_consultation.php
// Assure-toi d'avoir installé l'extension PHP pour Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379); // Adapté selon ta configuration

// Récupérer le nom ou l'ID de l'animal à partir d'un paramètre GET par exemple
$animalId = $_GET['animal_id'] ?? null;

if ($animalId) {
    // Incrémente le compteur pour cet animal
    $redis->incr("animal:{$animalId}:consultations");
    echo "Le compteur de consultations pour l'animal $animalId a été incrémenté.";
} else {
    echo "Aucun animal spécifié.";
}
?>