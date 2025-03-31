<!-- formulaire -->
<form action="./submit-avis.php" method="POST">
    <input type="hidden" name="service_id" value="<?= $serviceId ?>">
    <label>Votre nom :</label>
    <input type="text" name="nom" required>
    <label>Votre note :</label>
    <select name="note">
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select>
    <label>Votre avis :</label>
    <textarea name="commentaire" required></textarea>
    <button type="submit">Envoyer</button>
</form>

<!-- section reservation -->
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


<!-- section avis -->
<!--?php
include '../includes/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $nom = htmlspecialchars($_POST['nom']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $note = intval($_POST['note']);

    $sql = "INSERT INTO avisclients (service_id, nom, commentaire, note) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$service_id, $nom, $commentaire, $note]);

    header("Location: service-details.php?id=$service_id");
    exit();
}
?> -->

<!-- section reservation -->
<!--?php
include '../includes/db-connection.php';

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
?> -->

<!-- section avis -->
<section>
<!--?php
    $sqlAvis = "SELECT nom, commentaire, note, date_creation FROM avisclients WHERE service_id = ? ORDER BY date_creation DESC";
      $stmtAvis = $pdo->prepare($sqlAvis);
      $stmtAvis->execute([$serviceId]);
      $avisList = $stmtAvis->fetchAll();

      echo "<h2>Avis des visiteurs</h2>";
      foreach ($avisList as $avis) {
        echo "<p><strong>" . htmlspecialchars($avis['nom']) . "</strong> (" . $avis['note'] . "/5) :</p>";
        echo "<p>" . htmlspecialchars($avis['commentaire']) . "</p>";
        echo "<hr>";
      }
    ?> -->
  </section> 

  <!-- section reservation -->
  <section>
    <!--?php
      $sqlReservations = "SELECT date_reservation, nom FROM reservations WHERE service_id = ? ORDER BY date_reservation ASC";
      $stmtReservations = $pdo->prepare($sqlReservations);
      $stmtReservations->execute([$serviceId]);
      $reservations = $stmtReservations->fetchAll();

      echo "<h2>Dates réservées</h2>";
      foreach ($reservations as $res) {
          echo "<p>" . htmlspecialchars($res['nom']) . " - " . htmlspecialchars($res['date_reservation']) . "</p>";
      }
    ?>  -->
  </section>
