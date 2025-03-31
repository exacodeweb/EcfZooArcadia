





<!--?php   
require '../config/database.php';

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

$comptes_rendus = $pdo->prepare("
    SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
           CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    WHERE u.role = 'veterinaire'
    ORDER BY c.date_visite DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Historique des Comptes-Rendus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <!-- Bootstrap CSS -->  <!--
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 1rem;
    }
    h2 {
      text-align: center;
      margin-top: 20px;
      color: #343a40;
    }
    /* Utilisation d'une grille flexible pour les cartes */
    .card-deck {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1rem;
      margin-top: 20px;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border: none;
      border-radius: 0.5rem;
    }
    .card-title {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }
    .card p {
      font-size: 0.95rem;
      margin-bottom: 0.5rem;
    }
    @media (max-width: 768px) {
      .card-deck {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Historique des Comptes-Rendus</h2>
    <!?php if (empty($comptes_rendus)) : ?>
      <p class="text-center">Aucun compte-rendu trouvé.</p>
    <!?php else: ?>
      <div class="card-deck">
        <!?php foreach ($comptes_rendus as $crv): ?>
          <div class="card p-3">
            <h5 class="card-title">Date : <!?= date('d/m/Y', strtotime($crv['date_visite'])) ?></h5>
            <p><strong>Animal :</strong> <!?= htmlspecialchars($crv['nom_animal']) ?></p>
            <p><strong>Vétérinaire :</strong> <!?= htmlspecialchars($crv['veterinaire']) ?></p>
            <p><strong>État :</strong> <!?= htmlspecialchars($crv['etat_animal']) ?></p>
            <p><strong>Nourriture :</strong> <!?= htmlspecialchars($crv['nourriture']) ?></p>
            <p><strong>Grammage :</strong> <!?= htmlspecialchars($crv['grammage']) ?> kg</p>
            <p><strong>Détails :</strong> <!?= nl2br(htmlspecialchars($crv['detail_etat'])) ?></p>
          </div>
        <!?php endforeach; ?>
      </div>
    <!?php endif; ?>
  </div>
        -->
  <!-- Bootstrap JS Bundle -->  <!--
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>-->






<?php  
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Si vous souhaitez vérifier les résultats sans filtre, commentez la clause WHERE ci-dessous
$comptes_rendus = $pdo->prepare("
    SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
           CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    WHERE u.role = 'veterinaire'  -- Vérifiez que cette valeur correspond exactement à la donnée dans la table
    ORDER BY c.date_visite DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Comptes-Rendus</title>

    <style>
      body {
        background-color: #f8f9fa;
        font-size: 1rem;
        font-family: Arial, sans-serif;
      }
      h2 {
        margin-top: 20px;
        text-align: center;
        color: #343a40;
      }
      .table-responsive { margin-top: 1rem; }
      table { width: 100%; border-collapse: collapse; }
      th, td { padding: 1rem; text-align: center; vertical-align: middle; }
      th { background-color: #007bff; color: #fff; }
      td { font-size: 0.95rem; }

      @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
          display: block;
        }
        thead { display: none; }
        tr {
          border: 1px solid #ccc;
          margin-bottom: 1rem;
          padding: 0.5rem;
          border-radius: 0.5rem;
          background: #fff;
          box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
        }
        td {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 0.75rem;
          border: none;
          border-bottom: 1px solid #eee;
        }
        td:last-child { border-bottom: 0; }
        td::before {
          content: attr(data-label);
          font-weight: bold;
          color: #007bff;
          flex-basis: 40%;
          text-align: left;
        }
      }
    </style>


<!--<style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      font-size: 1rem;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    /* Formulaire de filtre */
    form label {
      font-weight: 600;
    }
    /* Tableau classique pour desktop */
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse;}
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }
    /* Responsive : transformation du tableau en cartes pour mobile */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.95rem;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }

    th {
      background: #007BFF !important;
    }
  </style>-->


<!--<style>
body {
  background-color: #f4f6f9;
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
  color: #333;
  padding: 20px;
}

h2 {
  text-align: center;
  color: #0056b3;
  font-weight: 600;
}

.table-container {
  max-width: 1200px;
  margin: auto;
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.table-responsive {
  margin-top: 1rem;
}

table {
  width: 100%;
  border-collapse: collapse;
  overflow: hidden;
  border-radius: 10px;
}

th, td {
  padding: 1rem;
  text-align: center;
  vertical-align: middle;
}

th {
  background-color: #007bff;
  color: #fff;
  font-weight: 600;
  text-transform: uppercase;
}

tr:nth-child(even) {
  background-color: #f8f9fa;
}

tr:hover {
  background-color: #e2e6ea;
  transition: 0.3s ease-in-out;
}

/* 🌍 Responsive : transformation du tableau en cartes pour mobile */
@media (max-width: 768px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }
  
  thead { display: none; }

  tr {
    border: 1px solid #ddd;
    margin-bottom: 1rem;
    padding: 10px;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
  }

  td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
  }

  td:last-child {
    border-bottom: 0;
  }

  td::before {
    content: attr(data-label);
    font-weight: bold;
    color: #007bff;
    flex-basis: 40%;
    text-align: left;
  }
}
</style>-->



</head>
<body>
<div class="table-container"><!------------------------------------->
    <h2>Historique des Comptes-Rendus</h2>
    <?php if (empty($comptes_rendus)) : ?>
        <p style="text-align: center;">Aucun compte-rendu trouvé.</p>
    <?php else: ?>
    <table>
        <tr>
            <th>Date</th>
            <th>Nom de l'Animal</th>
            <th>État</th>
            <th>Nourriture</th>
            <th>Grammage (kg)</th>
            <th>Détails</th>
            <th>Vétérinaire</th>
        </tr>
        <?php foreach ($comptes_rendus as $c) : ?>
            <tr>
                <!--<td><!?= htmlspecialchars($c['date_visite']) ?></td>-->
                <td><?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                <td><?= htmlspecialchars($c['nom_animal']) ?></td>
                <td><?= htmlspecialchars($c['etat_animal']) ?></td>
                <td><?= htmlspecialchars($c['nourriture']) ?></td>
                <td><?= htmlspecialchars($c['grammage']) ?></td>
                <td><?= htmlspecialchars($c['detail_etat']) ?></td>
                <td><?= htmlspecialchars($c['veterinaire']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

</div><!--------------------------->
</body>
</html>

<br>
<!--------------------------------------------- avec export format pdf ------------------------------------------------>
<!--?php 
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Vérification de la connexion
if (!$pdo) {
    die("Erreur de connexion à la base de données !");
}

// Récupération des vétérinaires pour le filtre
$veterinaires = $pdo->query("SELECT id, nom FROM utilisateurs WHERE role = 'veterinaire'")->fetchAll();

// Filtrage par vétérinaire
$veterinaire_id = isset($_GET['veterinaire_id']) ? $_GET['veterinaire_id'] : '';

$sql = "SELECT c.animal_id, a.nom AS nom_animal, c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire 
        FROM rapports_veterinaires c
        JOIN utilisateurs u ON c.veterinaire_id = u.id
        JOIN animaux a ON c.animal_id = a.id";

if (!empty($veterinaire_id)) {
    $sql .= " WHERE c.veterinaire_id = :veterinaire_id";
}

$sql .= " ORDER BY c.date_visite DESC";
$query = $pdo->prepare($sql);

if (!empty($veterinaire_id)) {
    $query->bindParam(':veterinaire_id', $veterinaire_id, PDO::PARAM_INT);
}

$query->execute();
$comptes_rendus = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Comptes-Rendus</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #343a40;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        select, button {
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Historique des Comptes-Rendus</h2>  ------------------->

        <!-- Formulaire de filtre -->  <!-----------------------
        <form method="GET">
            <label for="veterinaire_id">Filtrer par vétérinaire :</label>
            <select name="veterinaire_id" id="veterinaire_id">
                <option value="">-- Tous les vétérinaires --</option>
                <!?php foreach ($veterinaires as $vet) : ?>
                    <option value="<!?= $vet['id'] ?>" <!?= ($vet['id'] == $veterinaire_id) ? 'selected' : '' ?>>
                        <!?= htmlspecialchars($vet['nom']) ?>
                    </option>
                <!?php endforeach; ?>
            </select>
            <button type="submit">Filtrer</button>
        </form>  -------------------------------->

        <!-- Bouton Export PDF -->   <!------------------
        <form action="export_pdf.php" method="POST">
            <input type="hidden" name="veterinaire_id" value="<!?= htmlspecialchars($veterinaire_id) ?>">
            <button type="submit">Exporter en PDF</button>
        </form>

        <!?php if (!empty($comptes_rendus)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Animal</th>
                        <th>Nom Animal</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Nourriture</th>
                        <th>Grammage (kg)</th>
                        <th>Détails</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                            <td><!?= htmlspecialchars($c['animal_id']) ?></td>
                            <td><!?= htmlspecialchars($c['nom_animal']) ?></td>
                            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                            <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                            <td><!?= htmlspecialchars($c['grammage']) ?></td>
                            <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        <!?php else : ?>
            <p style="text-align: center; color: red;">Aucun compte-rendu trouvé.</p>
        <!?php endif; ?>
    </div>
</body>
</html>  ---------------------------->
<!--------------------------------------------------------------------------------------------------------------------->


<!-- 
SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.prenom AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    ORDER BY c.date_visite DESC



SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
       CONCAT(u.prenom, ' ', u.nom) AS veterinaire, a.prenom AS nom_animal 
FROM rapports_veterinaires c 
JOIN utilisateurs u ON c.veterinaire_id = u.id 
JOIN animaux a ON c.animal_id = a.id 
ORDER BY c.date_visite DESC

-->
<!----------------------------------------------------version-2-------------------------------------------------->
<!--?php 
require '../config/database.php';

/*$comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
       CONCAT(u.prenom, ' ', u.nom) AS veterinaire, a.prenom AS nom_animal 
FROM rapports_veterinaires c 
JOIN utilisateurs u ON c.veterinaire_id = u.id 
JOIN animaux a ON c.animal_id = a.id 
ORDER BY c.date_visite DESC
");*/

/*$comptes_rendus = $pdo->prepare("SELECT c.date_visite, 
       c.etat_animal, 
       c.nourriture, 
       c.grammage, 
       c.detail_etat, 
       CONCAT(u.prenom, ' ', u.nom) AS veterinaire, 
       a.prenom AS nom_animal 
FROM rapports_veterinaires c 
JOIN utilisateurs u ON c.veterinaire_id = u.id 
JOIN animaux a ON c.animal_id = a.id 
WHERE u.role = 'veterinaire'  -- 🔥 Filtre uniquement les vétérinaires
ORDER BY c.date_visite DESC;
");*/

$comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
           CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    WHERE u.role = 'veterinaire'  -- 🔥 On filtre bien les vétérinaires
    ORDER BY c.date_visite DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Comptes-Rendus</title>
    <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }
  </style>
</head>
<body>
    <h2>Historique des Comptes-Rendus</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Nom de l'Animal</th>
            <th>État</th>
            <th>Nourriture</th>
            <th>Grammage (kg)</th>
            <th>Détails</th>
            <th>Vétérinaire</th>
        </tr>
        <!-?php foreach ($comptes_rendus as $c) : ?>
            <tr>  -->
                <!--<td><!-?= htmlspecialchars($c['date_visite']) ?></td>--> <!--
                <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                <td><!?= htmlspecialchars($c['nom_animal']) ?></td>
                <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                <td><!?= htmlspecialchars($c['grammage']) ?></td>
                <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
            </tr>
        <!?php endforeach; ?>
    </table>
</body>
</html> -->

<!-------------------------------------------------version-3----------------------------------------------------->

<!--?php 
require '../config/database.php';

// Vérification de la connexion
if (!$pdo) {
    die("Erreur de connexion à la base de données !");
}

// Récupération de tous les comptes rendus
$query = $pdo->query("SELECT c.animal_id, c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, CONCAT(u.nom, ' ', u.prenom) AS veterinaire 
FROM rapports_veterinaires c 
JOIN utilisateurs u ON c.veterinaire_id = u.id 
ORDER BY c.date_visite DESC"



/*SELECT c.animal_id, c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire FROM rapports_veterinaires c JOIN utilisateurs u ON c.veterinaire_id = u.id ORDER BY c.date_visite DESC"
*/

);

//$comptes_rendus->execute();
//$comptes_rendus = $comptes_rendus->fetchAll();

 $comptes_rendus = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Comptes-Rendus</title>
    <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    h2 {
      text-align: center;
      margin-top: 20px;
      color: #343a40;
    }
    .table-container {
      max-width: 1000px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    table { 
      width: 100%; 
      border-collapse: collapse; 
      margin-top: 10px; 
    }
    th, td { 
      padding: 12px; 
      text-align: center; 
      border: 1px solid #ddd;
    }
    th { 
      background-color: #007bff; 
      color: #fff; 
    }
    td { font-size: 0.95rem; }
    
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display: block; }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-bottom: 1px solid #eee;
      }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
      }
    }
  </style>
</head>
<body>
    <div class="table-container">
        <h2>Historique des Comptes-Rendus</h2>

        <!?php if (!empty($comptes_rendus)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Animal</th>                     
                        <th>Date</th>
                        <th>État</th>
                        <th>Nourriture</th>
                        <th>Grammage (kg)
                        <th>Détails</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                            <td><!?= htmlspecialchars($c['animal_id']) ?></td>
                            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                            <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                            <td><!?= htmlspecialchars($c['grammage']) ?></td>
                            <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        <!?php else : ?>
            <p style="text-align: center; color: red;">Aucun compte-rendu trouvé.</p>
        <!?php endif; ?>
    </div>
</body>
</html>
        -->
<!--------------------------------------------------------------------------------------------------------------->

<!--?php 
require '../config/database.php';

// Vérification de la connexion
if (!$pdo) {
    die("Erreur de connexion à la base de données !");
}

// Sécurisation et récupération de l'ID de l'animal
$animal_id = isset($_GET['animal_id']) ? intval($_GET['animal_id']) : 0;
$comptes_rendus = [];

if ($animal_id > 0) {
    $query = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire 
        FROM comptes_rendus_veterinaires c
        JOIN utilisateurs u ON c.veterinaire_id = u.id
        WHERE c.animal_id = ?
        ORDER BY c.date_visite DESC
    ");

    $query->execute([$animal_id]);
    $comptes_rendus = $query->fetchAll();
}
?>  -->

<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Comptes-Rendus - Animal <!?= htmlspecialchars($animal_id) ?></title>
    <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    .table-container {
      max-width: 900px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    table { 
      width: 100%; 
      border-collapse: collapse; 
      margin-top: 10px; 
    }
    th, td { 
      padding: 12px; 
      text-align: center; 
      border: 1px solid #ddd;
    }
    th { 
      background-color: #007bff; 
      color: #fff; 
    }
    td { font-size: 0.95rem; }
    
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr { display: block; }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-bottom: 1px solid #eee;
      }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
      }
    }
  </style>
</head>
<body>
    <div class="table-container">
        <h2>Historique des Comptes-Rendus pour l'animal <!?= htmlspecialchars($animal_id) ?></h2>

        <!?php if (!empty($comptes_rendus)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>État</th>
                        <th>Nourriture</th>
                        <th>Grammage (kg)</th>
                        <th>Détails</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                            <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                            <td><!?= htmlspecialchars($c['grammage']) ?></td>
                            <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        <!?php else : ?>
            <p style="text-align: center; color: red;">Aucun compte-rendu disponible pour cet animal.</p>
        <!?php endif; ?>
    </div>
</body>
</html>











<!?php 
require '../config/database.php';

// Vérification de la connexion à la base de données
if (!$pdo) {
    die("Erreur de connexion à la base de données !");
}

// Sécurisation de l'ID de l'animal
$animal_id = isset($_GET['animal_id']) ? intval($_GET['animal_id']) : 0;

// Vérification que l'ID est valide avant d'exécuter la requête
if ($animal_id > 0) {
    $comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire 
        FROM comptes_rendus_veterinaires c
        JOIN utilisateurs u ON c.veterinaire_id = u.id
        WHERE c.animal_id = ?
        ORDER BY c.date_visite DESC
    ");

    $comptes_rendus->execute([$animal_id]);
    $comptes_rendus = $comptes_rendus->fetchAll();
} else {
    $comptes_rendus = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Comptes-Rendus</title>
    <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }
    
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }
  </style>
</head>
<body>
    <h2>Historique des Comptes-Rendus</h2>

    <!?php if (!empty($comptes_rendus)) : ?>
        <table border="1">
            <tr>
                <th>Date</th>
                <th>État</th>
                <th>Nourriture</th>
                <th>Grammage (kg)</th>
                <th>Détails</th>
                <th>Vétérinaire</th>
            </tr>
            <!?php foreach ($comptes_rendus as $c) : ?>
                <tr>
                    <td><!?= htmlspecialchars($c['date_visite']) ?></td>
                    <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                    <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                    <td><!?= htmlspecialchars($c['grammage']) ?></td>
                    <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                    <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                </tr>
            <!?php endforeach; ?>
        </table>
    <!?php else : ?>
        <p style="text-align: center; color: red;">Aucun compte-rendu disponible pour cet animal.</p>
    <!?php endif; ?>

</body>
</html>
















<!?php 
require '../config/database.php';
//require '../service_veterinaire/db.php';

$animal_id = $_GET['animal_id'] ?? '';/*comptes_rendus_veterinaires*/
$comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire FROM rapports_veterinaires c JOIN utilisateurs u ON c.veterinaire_id = u.id WHERE c.animal_id = ? ORDER BY c.date_visite DESC");

$comptes_rendus->execute([$animal_id]);
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Comptes-Rendus</title>
    <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    /* Tableau classique pour desktop */
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }
    
    /* Responsive : transformation du tableau en cartes sur mobile */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }
  </style>
</head>
<body>
    <h2>Historique des Comptes-Rendus</h2>
    <table border-radius="1">
        <tr>
            <th>Date</th>
            <th>État</th>
            <th>Nourriture</th>
            <th>Grammage (kg)</th>
            <th>Détails</th>
            <th>Vétérinaire</th>
        </tr>
        <!?php foreach ($comptes_rendus as $c) : ?>
            <tr> -->
                <!--<td><!?= $c['date_passage'] ?></td>--> <!--
                <td><!?= $c['date_visite'] ?></td>
                <td><!?= $c['etat_animal'] ?></td> -->
                <!--<td><!?= $c['nourriture_proposee'] ?></td>--> <!--
                <td><!?= $c['nourriture'] ?></td>
                <td><!?= $c['grammage'] ?></td> -->
                <!--<td><!?= $c['details_etat'] ?></td>--> <!--
                <td><!?= $c['detail_etat'] ?></td>
                <td><!?= $c['veterinaire'] ?></td>
            </tr>
        <!?php endforeach; ?>
    </table>
</body>
</html>







<!-?php  
require '../config/database.php';

$animal_id = $_GET['animal_id'] ?? '';/*comptes_rendus_veterinaires*/
$comptes_rendus = $pdo->prepare(" SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire FROM rapports_veterinaires c JOIN utilisateurs u ON c.veterinaire_id = u.id WHERE c.animal_id = ? ORDER BY c.date_visite DESC");
$comptes_rendus->execute([$animal_id]);
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Historique des Comptes-Rendus</title> -->
  <!-- Bootstrap CSS -->  <!--
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    /* Tableau classique pour desktop */
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }
    
    /* Responsive : transformation du tableau en cartes sur mobile */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }
  </style>
</head>
<body>
  <div class="container my-4">
    <h2>Historique des Comptes-Rendus</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Date</th>
            <th>État</th>
            <th>Nourriture</th>
            <th>Grammage (kg)</th>
            <th>Détails</th>
            <th>Vétérinaire</th>
          </tr>
        </thead>
        <tbody>
          <!?php foreach ($comptes_rendus as $c) : ?>
            <tr>
              <td data-label="Date"><!?= htmlspecialchars($c['date_visite']) ?></td>
              <td data-label="État"><!?= htmlspecialchars($c['etat_animal']) ?></td>
              <td data-label="Nourriture"><!?= htmlspecialchars($c['nourriture']) ?></td>
              <td data-label="Grammage (kg)"><!?= htmlspecialchars($c['grammage']) ?></td>
              <td data-label="Détails"><!?= htmlspecialchars($c['detail_etat']) ?></td>
              <td data-label="Vétérinaire"><!?= htmlspecialchars($c['veterinaire']) ?></td>
            </tr>
          <!?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
          -->

 

          <!-- rapports_veterinaires --> <!--  -->
<!---------------------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------------->

<!--
L'énoncé du chahier des charges
 L'état de l’animal
 La nourriture proposée
 Le grammage de la nourriture
 Date de passage
 Détail de l’état de l’animal (information facultative)
-->
<!--$sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";-->




<!-- la Table: 	id	veterinaire_id	animal_id	date_visite	etat_animal	nourriture	grammage	detail_etat	-->


<!--
    SELECT c.date_passage, c.etat_animal, c.nourriture_proposee, c.grammage, c.details_etat, u.nom AS veterinaire
   
    ORDER BY c.date_passage DESC



-->

    <!--?php
require '../config/database.php';

$animal_id = $_GET['animal_id'] ?? '';
$comptes_rendus = $pdo->prepare("

    SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire
    FROM comptes_rendus_veterinaires c
    JOIN users u ON c.veterinaire_id = u.id
    WHERE c.animal_id = ?

    ORDER BY c.date_visite DESC
");

          -->





<?php  
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé


// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

$comptes_rendus = $pdo->prepare("
    SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
           CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    WHERE u.role = 'veterinaire'
    ORDER BY c.date_visite DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historique des Comptes-Rendus</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #0056b3;
            font-weight: 600;
        }

        /* Conteneur principal */
        .table-container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
            /*border-radius: 10px;*/
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* TABLEAU CLASSIQUE *//*
        @media (min-width: 769px) {
            table {
                width: 100%;
                border-collapse: collapse;    /*
                /*border-radius: 10px;*/   /*
                overflow: hidden;
            }

            th, td {
                padding: 12px;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }

            th {
                background: #007bff;
                color: #fff;
                font-weight: bold;
                text-transform: uppercase;
            }

            tr:nth-child(even) {
                background: #f8f9fa;
            }

            tr:hover {
                background: #e2e6ea;
                transition: 0.3s;
            }
        }*/


        /* 🌍 MODE MOBILE : Transformation en cartes *//*
        @media (max-width: 768px) {
            table, thead, tbody, th, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                display: flex;
                flex-direction: column;
                background: white;
                margin-bottom: 15px;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                border-bottom: 1px solid #eee;
            }

            td:last-child {
                border-bottom: none;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #007bff;
                flex-basis: 50%;
                text-align: left;
            }
        }*/





        /* 🌍 MODE MOBILE : Transformation en cartes + Masquer <th> */
@media (max-width: 768px) {
    table, thead, tbody, th, tr {
        display: block;
    }

    thead, th {
        display: none;  /* ✅ Cache les titres du tableau */
    }

    tr {
        display: flex;
        flex-direction: column;
        background: white;
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    }

    td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    td:last-child {
        border-bottom: none;
    }

    td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 50%;
        text-align: left;
    }
}
    </style>

</head>
<body>

<div class="table-container">
    <h2>Historique des Comptes-Rendus</h2>

    <?php if (empty($comptes_rendus)) : ?>
        <p style="text-align: center;">Aucun compte-rendu trouvé.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Nom de l'Animal</th>
                <th>État</th>
                <th>Nourriture</th>
                <th>Grammage (kg)</th>
                <th>Détails</th>
                <th>Vétérinaire</th>
            </tr>
            <?php foreach ($comptes_rendus as $c) : ?>
                <tr>
                    <td data-label="Date"><?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                    <td data-label="Nom de l'Animal"><?= htmlspecialchars($c['nom_animal']) ?></td>
                    <td data-label="État"><?= htmlspecialchars($c['etat_animal']) ?></td>
                    <td data-label="Nourriture"><?= htmlspecialchars($c['nourriture']) ?></td>
                    <td data-label="Grammage (kg)"><?= htmlspecialchars($c['grammage']) ?></td>
                    <td data-label="Détails"><?= htmlspecialchars($c['detail_etat']) ?></td>
                    <td data-label="Vétérinaire"><?= htmlspecialchars($c['veterinaire']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>









        <!-- Bouton Export PDF -->  
        <form action="export_pdf.php" method="POST">
            <input type="hidden" name="veterinaire_id" value="<?= htmlspecialchars($veterinaire_id) ?>">
            <button type="submit">Exporter en PDF</button>
        </form>

        <?php if (!empty($comptes_rendus)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Animal</th>
                        <th>Nom Animal</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Nourriture</th>
                        <th>Grammage (kg)</th>
                        <th>Détails</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                        <td data-label="Date"><?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                        <td data-label="Nom de l'Animal"><?= htmlspecialchars($c['nom_animal']) ?></td>
                        <td data-label="État"><?= htmlspecialchars($c['etat_animal']) ?></td>
                        <td data-label="Nourriture"><?= htmlspecialchars($c['nourriture']) ?></td>
                        <td data-label="Grammage (kg)"><?= htmlspecialchars($c['grammage']) ?></td>
                        <td data-label="Détails"><?= htmlspecialchars($c['detail_etat']) ?></td>
                        <td data-label="Vétérinaire"><?= htmlspecialchars($c['veterinaire']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p style="text-align: center; color: red;">Aucun compte-rendu trouvé.</p>
        <?php endif; ?>







</body>
</html>















        <!-- Bouton Export PDF -->   <!------------------
        <form action="export_pdf.php" method="POST">
            <input type="hidden" name="veterinaire_id" value="<!?= htmlspecialchars($veterinaire_id) ?>">
            <button type="submit">Exporter en PDF</button>
        </form>

        <!?php if (!empty($comptes_rendus)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Animal</th>
                        <th>Nom Animal</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Nourriture</th>
                        <th>Grammage (kg)</th>
                        <th>Détails</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                            <td><!?= htmlspecialchars($c['animal_id']) ?></td>
                            <td><!?= htmlspecialchars($c['nom_animal']) ?></td>
                            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($c['etat_animal']) ?></td>
                            <td><!?= htmlspecialchars($c['nourriture']) ?></td>
                            <td><!?= htmlspecialchars($c['grammage']) ?></td>
                            <td><!?= htmlspecialchars($c['detail_etat']) ?></td>
                            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        <!?php else : ?>
            <p style="text-align: center; color: red;">Aucun compte-rendu trouvé.</p>
        <!?php endif; ?>



