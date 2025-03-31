<?php
//require_once 'utilise.php';
require_once 'config/config_unv.php';

$pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$habitat_id = $_GET['id'] ?? 0;

$habitat = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
$habitat->execute([$habitat_id]);
$habitat = $habitat->fetch(PDO::FETCH_ASSOC);

$avis = $pdo->prepare("SELECT a.commentaire, u.nom AS veterinaire, a.date_creation 
                       FROM avis_habitats a 
                       JOIN users u ON a.veterinaire_id = u.id 
                       WHERE a.habitat_id = ?");
$avis->execute([$habitat_id]);
$avis = $avis->fetchAll(PDO::FETCH_ASSOC);
?>

<h2><?= htmlspecialchars($habitat['nom']) ?></h2>
<p><?= htmlspecialchars($habitat['description']) ?></p>

<h3>Avis du vétérinaire :</h3>
<ul>
    <?php foreach ($avis as $a): ?>
        <li>
            <strong><?= htmlspecialchars($a['veterinaire']) ?> (<?= $a['date_creation'] ?>) :</strong>
            <?= htmlspecialchars($a['commentaire']) ?>
        </li>
    <?php endforeach; ?>
</ul>

