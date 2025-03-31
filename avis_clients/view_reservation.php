  <!-- section reservation -->
  <section>
    <?php
      $sqlReservations = "SELECT date_reservation, nom FROM reservations WHERE service_id = ? ORDER BY date_reservation ASC";
      $stmtReservations = $pdo->prepare($sqlReservations);
      $stmtReservations->execute([$serviceId]);
      $reservations = $stmtReservations->fetchAll();

      echo "<h2>Dates réservées</h2>";
      foreach ($reservations as $res) {
          echo "<p>" . htmlspecialchars($res['nom']) . " - " . htmlspecialchars($res['date_reservation']) . "</p>";
      }
    ?>
  </section>