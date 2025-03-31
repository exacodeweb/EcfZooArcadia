<!-- section reservation -->
<?php
include '../config/database.php';
?>

<form action="submit-reservation.php" method="POST">
  <input type="hidden" name="service_id" value="<?= $serviceId ?>">
  <label>Date :</label>
  <input type="date" name="date_reservation" required>
  <label>Nom :</label>
  <input type="text" name="nom" required>
  <label>Email :</label>
  <input type="email" name="email" required>
  <button type="submit">Réserver</button>
</form>