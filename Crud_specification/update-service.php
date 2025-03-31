





<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $specificites = $_POST['specificites'];

    $sql = "UPDATE services SET specificites = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$specificites, $id]);

    echo "Mise à jour réussie !";
}
?>

