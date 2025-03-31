<?php
// Assurez-vous d'installer l'extension MongoDB via Composer : composer require mongodb/mongodb
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->parrotDB->habitatStats; // par exemple, dans la base parrotDB, collection habitatStats

// Supposons que vous récupérez l'identifiant ou le prénom de l'animal, ici par exemple via un paramètre GET
$animalName = $_GET['animal'] ?? null;

if ($animalName) {
    // Incrémente le compteur pour l'animal spécifié, avec "upsert" pour créer le document s'il n'existe pas.
    $result = $collection->updateOne(
        ['nom' => $animalName],
        ['$inc' => ['consultations' => 1]],
        ['upsert' => true]
    );
    echo "Le compteur pour {$animalName} a été incrémenté.";
} else {
    echo "Aucun animal spécifié.";
}
?>







<?php
// nosql/mongodb/increment_consultation.php
require 'vendor/autoload.php'; // Assure-toi d'avoir installé le driver MongoDB via Composer

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->myDatabase->animalStats; // Exemple de base et collection

// Récupérer l'ID de l'animal depuis GET
$animalId = $_GET['animal_id'] ?? null;

if ($animalId) {
    $result = $collection->updateOne(
        ['animal_id' => $animalId],
        ['$inc' => ['consultations' => 1]],
        ['upsert' => true]
    );
    echo "Compteur mis à jour pour l'animal $animalId.";
} else {
    echo "Aucun animal spécifié.";
}
?>