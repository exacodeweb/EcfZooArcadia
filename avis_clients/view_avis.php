<section>
<?php
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
    ?>
  </section><!-- section avis -->