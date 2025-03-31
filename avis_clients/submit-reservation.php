<?php
include 'db.php';// ../includes/db-connection.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $date_reservation = $_POST['date_reservation'];
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);

    $sql = "INSERT INTO reservations (service_id, date_reservation, nom, email) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$service_id, $date_reservation, $nom, $email]);

    echo "Réservation enregistrée avec succès !";
    header("Location: service-details.php?id=$service_id");
    exit();
}
?>