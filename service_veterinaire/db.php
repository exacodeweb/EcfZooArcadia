<?php
//$config = require '../config/config.php'; // Récupère la configuration
$config = require '../config/config_unv.php'; /*Test*/

try {
  $pdo = new PDO(                                                     //database
    "mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'] . ";charset=" . $config['db']['charset'],
    $config['db']['username'],
    $config['db']['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
