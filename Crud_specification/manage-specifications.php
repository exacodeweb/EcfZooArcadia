<?php 
require_once '../config/config_unv.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gérer les spécifications</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script>
    function filterTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("tbody tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }
  </script>
</head>

<body class="bg-light">

  <div class="container mt-4">
    <h1 class="text-center mb-4">Gestion des Spécifications</h1>

    <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une spécification..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($specifications as $spec): ?>
            <tr>
              <td><?= htmlspecialchars($spec['service_nom']) ?></td>
              <td><?= htmlspecialchars($spec['titre']) ?></td>
              <td><?= htmlspecialchars($spec['valeur']) ?></td>

              <td>
                <!-- Bouton de suppression avec confirmation -->
                <button class="btn btn-danger" onclick="confirmDelete(<?php echo $spec['spec_id']; ?>)">Supprimer</button>
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <script>
        function confirmDelete(specId) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cette spécification ?")) {
            // Si l'utilisateur confirme, rediriger vers le fichier de suppression avec l'ID correct
            window.location.href = 'delete-specification.php?id=' + specId;
          }
        }
      </script>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>










<!--?php 
require_once '../config/config_unv.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gérer les spécifications</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script>
    function filterTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("tbody tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }
  </script>
</head>

<body class="bg-light">

  <div class="container mt-4">
    <h1 class="text-center mb-4">Gestion des Spécifications</h1>

    <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une spécification..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!?php foreach ($specifications as $spec): ?>
            <tr>
              <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
              <td><!?= htmlspecialchars($spec['titre']) ?></td>
              <td><!?= htmlspecialchars($spec['valeur']) ?></td>

              <td> ---------------------------->
                <!-- Bouton de suppression avec confirmation -->  <!-------------------------
                <button class="btn btn-danger" onclick="confirmDelete(<!?php echo $spec['spec_id']; ?>)">Supprimer</button>
              </td>

            </tr>  --------------------->
          <!--?php endforeach; ?>
        </tbody>
      </table>

      <script>
        function confirmDelete(specId) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cette spécification ?")) {
            // Si l'utilisateur confirme, rediriger vers le fichier de suppression
            window.location.href = 'delete-specification.php?id=' + specId;
          }
        }
      </script>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
----------------------------->














<!--?php
//include '../config/config_unv.php';
require_once '../config/config_unv.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gérer les spécifications</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script>
    function filterTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("tbody tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }
  </script>
</head>

<body class="bg-light">

  <div class="container mt-4">
    <h1 class="text-center mb-4">Gestion des Spécifications</h1>

    <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une spécification..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover">

        <!?php
        // Exemple de tableau de spécifications
        $specifications = $pdo->query("SELECT id, titre FROM specifications")->fetchAll();
        ?>

        <thead class="table-dark">
          <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!?php foreach ($specifications as $spec): ?>
            <tr>
              <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
              <td><!?= htmlspecialchars($spec['titre']) ?></td>
              <td><!?= htmlspecialchars($spec['valeur']) ?></td>  --------------------->
              <!--<td>
                <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('Supprimer cette spécification ?');">
                  🗑 Supprimer
                </a>
              </td>-->  <!--

              <td>  --->
                <!-- Bouton de suppression avec confirmation -->   <!-------------------------
                <button class="btn btn-danger" onclick="confirmDelete(<-?php echo $spec['id']; ?>)">Supprimer</button>
              </td>

            </tr>
          <!?php endforeach; ?>
        </tbody>
      </table>

      <script>
        function confirmDelete(specId) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cette spécification ?")) {
            // Si l'utilisateur confirme, rediriger vers le fichier de suppression
            window.location.href = 'delete-specification.php?id=' + specId;
          }
        }
      </script>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
 ----------------------->


<!--?php
// Exemple de tableau de spécifications
$specifications = $pdo->query("SELECT id, titre FROM specifications")->fetchAll();
?>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Titre</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <!?php foreach ($specifications as $spec) : ?>
      <tr>
        <td><!?php echo htmlspecialchars($spec['id']); ?></td>
        <td><!?php echo htmlspecialchars($spec['titre']); ?></td>
        <td> -->
<!-- Bouton de suppression avec confirmation --> <!--
          <button class="btn btn-danger" onclick="confirmDelete(<!?php echo $spec['id']; ?>)">Supprimer</button>
        </td>
      </tr>
    <!?php endforeach; ?>
  </tbody>
</table>

<script>
  function confirmDelete(specId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette spécification ?")) {
      // Si l'utilisateur confirme, rediriger vers le fichier de suppression
      window.location.href = 'delete-specification.php?id=' + specId;
    }
  }
</script>
-->

<!--------------------------------------------------------------------------------------------------------------------->






<!--?php
include '../includes/db-connection.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les spécifications</title>
</head>
<body>

<h1>Gestion des spécifications</h1>

<table border="1">
    <thead>
        <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!?php foreach ($specifications as $spec): ?>
            <tr>
                <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
                <td><!?= htmlspecialchars($spec['titre']) ?></td>
                <td><!?= htmlspecialchars($spec['valeur']) ?></td>
                <td>
                    <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>" onclick="return confirm('Supprimer cette spécification ?');">🗑 Supprimer</a>
                </td>
            </tr>
        <!?php endforeach; ?>
    </tbody>
</table>

</body>
</html> ------------>

<!--------------------------------------------------------------------------------------------------------------------->












<!--?php
require_once '../config/config_unv.php'; // Connexion via fichier centralisé

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les spécifications</title>
</head>
<body>

<h1>Gestion des spécifications</h1>

<table border="1">
    <thead>
        <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!?php foreach ($specifications as $spec): ?>
            <tr>
                <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
                <td><!?= htmlspecialchars($spec['titre']) ?></td>
                <td><!?= htmlspecialchars($spec['valeur']) ?></td>
                <td>
                    <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>" onclick="return confirm('Supprimer cette spécification ?');">🗑 Supprimer</a>
                </td>
            </tr>
        <!?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
        -->




































<!--?php
include '../includes/db-connection.php';
//require_once '../config/config_unv.php'; 

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les spécifications</title>
</head>
<body>

<h1>Gestion des spécifications</h1>

<table border="1">
    <thead>
        <tr>
            <th>Service</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!?php foreach ($specifications as $spec): ?>
            <tr>
                <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
                <td><!?= htmlspecialchars($spec['titre']) ?></td>
                <td><!?= htmlspecialchars($spec['valeur']) ?></td>
                <td>
                    <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>" onclick="return confirm('Supprimer cette spécification ?');">🗑 Supprimer</a>
                </td>
            </tr>
        <!?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
        -->
















<br>



<!-- ! En cooiur de developp N°1 -->

<!--?php 
include '../includes/db-connection.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer les spécifications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function filterTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="text-center mb-4">Gestion des Spécifications</h1>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une spécification..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Service</th>
                    <th>Titre</th>
                    <th>Valeur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!?php foreach ($specifications as $spec): ?>
                    <tr>
                        <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
                        <td><!?= htmlspecialchars($spec['titre']) ?></td>
                        <td><!?= htmlspecialchars($spec['valeur']) ?></td>
                        <td>
                            <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Supprimer cette spécification ?');">
                               🗑 Supprimer
                            </a>
                        </td>
                    </tr>
                <!?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->



<!-- Encour de developp Essai N°2 à Testé -->

<br>




<!----------------------------------->


<br>



<!-- ! Test semble ok à confirmé -->

<!--?php 
//include '../config/config_unv.php';
require_once '../config/config_unv.php';

// Récupérer toutes les spécifications avec les services associés
$sql = "SELECT s.id AS spec_id, s.titre, s.valeur, sv.nom AS service_nom
        FROM specifications s
        JOIN services sv ON s.service_id = sv.id
        ORDER BY sv.nom, s.titre";
$specifications = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gérer les spécifications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function filterTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="text-center mb-4">Gestion des Spécifications</h1>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une spécification..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Service</th>
                    <th>Titre</th>
                    <th>Valeur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!?php foreach ($specifications as $spec): ?>
                    <tr>
                        <td><!?= htmlspecialchars($spec['service_nom']) ?></td>
                        <td><!?= htmlspecialchars($spec['titre']) ?></td>
                        <td><!?= htmlspecialchars($spec['valeur']) ?></td>
                        <td>
                            <a href="delete-specification.php?id=<!?= $spec['spec_id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Supprimer cette spécification ?');">
                               🗑 Supprimer
                            </a>
                        </td>
                    </tr>
                <!?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>