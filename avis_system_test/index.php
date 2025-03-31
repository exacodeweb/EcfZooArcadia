<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>



  <section id="avis">
    <h3>Ce que disent nos visiteurs</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php// Avis
                $stmt = $pdo->query("SELECT auteur, message, date_creation FROM avis WHERE statut = 'valide' ORDER BY date_creation DESC LIMIT 10");
                $avisValides = $stmt->fetchAll();

                foreach ($avisValides as $avis): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($avis['auteur']); ?></td>
                        <td><?php echo htmlspecialchars($avis['message']); ?></td>
                        <td><?php echo htmlspecialchars(strftime('%d %B %Y', strtotime($avis['date_creation']))); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="avis-actions">
        <a href="tous-les-avis.php" class="btn">Voir tous les avis</a>
        <a href="#form-avis" class="btn">Laisser un avis</a>
    </div>
</section>












  <!---------------------------------------------- Laisser un avis ---------------------------------------------------->
  <section id="avis" class="text-center my-4">
    <h2>Avis des Visiteurs</h2>
    <div class="avis-container-wrapper">
      <div class="avis-container">
        <!-- Les avis approuvés seront insérés dynamiquement ici -->
      </div>
    </div>
    <button onclick="window.location.href='avis.html'" class="btn btn-primary mt-3">Voir tous les avis</button>
    <button onclick="window.location.href='soumettre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>
  </section>

<!--------------------------------------------------- VERSION-1 ------------------------------------------------------->
<!-- HTML de Base -->
<section id="avis" class="text-center my-4">
  <h2>Avis des Visiteurs</h2>
  <div class="avis-container">
    <!-- Les avis seront insérés dynamiquement ici -->
  </div>
  <button onclick="window.location.href='avis.html'" class="btn btn-primary mt-3">Voir tous les avis</button>
</section>

<!-- JavaScript pour insérer dynamiquement les avis -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  // Exemple de données d'avis (vous pouvez les remplacer par un fetch à une API)
  const avisData = [
    {
      message: "Une expérience incroyable ! Les habitats sont magnifiques.",
      auteur: "Jean Dupont-X",
    },
    {
      message: "Le zoo est bien entretenu et les animaux sont bien traités.",
      auteur: "Marie Curie",
    },
    {
      message: "Un endroit parfait pour passer une journée en famille.",
      auteur: "Albert Einstein",
    },
  ];



  <?php
  $conn = new mysqli("localhost", "root", "G1i9e6t3", "zoo_arcadia");
  
  if ($conn->connect_error) {
      die("Erreur de connexion : " . $conn->connect_error);
  }
  
  // Récupérer les 10 derniers avis approuvés //Avis
  $query = "SELECT nom, message, dateSoumission FROM avis WHERE statut = 'approuve' ORDER BY dateSoumission DESC LIMIT 10";
  $result = $conn->query($query);
  ?>
  
  <div class="avis-carousel">
      <div class="carousel-container">
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "
                  <div class='carousel-card'>
                      <h3>" . htmlspecialchars($row['nom']) . "</h3>
                      <p>" . htmlspecialchars($row['message']) . "</p>
                      <small>Posté le : " . htmlspecialchars(date("d/m/Y", strtotime($row['dateSoumission']))) . "</small>
                  </div>";
              }
          } else {
              echo "<p>Aucun avis disponible pour le moment.</p>";
          }
          ?>
      </div>
  </div>
  
  <?php
  $conn->close();
  ?>








  
    // Cible la div contenant les avis
    const avisContainer = document.querySelector(".avis-container");
  
    // Insère les avis dans le DOM
    avisData.forEach((avis) => {
      const avisElement = document.createElement("div");
      avisElement.className = "avis";
  
      avisElement.innerHTML = `
        <p>“${avis.message}”</p>
        <cite>- ${avis.auteur}</cite>
      `;
  
      avisContainer.appendChild(avisElement);
    });
  });
  
</script>


  <script>
  fetch("./avis-api.php")
  .then((response) => response.json())
  .then((avisData) => {
    avisData.forEach((avis) => {
      const avisElement = document.createElement("div");
      avisElement.className = "avis";
      avisElement.innerHTML = `
        <p>“${avis.message}”</p>
        <cite>- ${avis.auteur}</cite>
      `;
      avisContainer.appendChild(avisElement);
    });
  });
</script>


<script src="../js/script.js"></script>

</body>
</html>

















