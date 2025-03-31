<?php
//require_once 'utilise.php';
require_once '../config/config_unv.php';

$pdo = new PDO("mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4", "root", "G1i9e6t3", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$habitats = $pdo->query("SELECT * FROM habitats")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Habitats</h2>
<ul>
    <?php foreach ($habitats as $habitat): ?>
        <li>
            <a href="habitat-details.php?id=<?= $habitat['id'] ?>">
                <?= htmlspecialchars($habitat['nom']) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>