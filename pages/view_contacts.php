<?php
// Consultation des Contacts

session_start();
if (!isset($_SESSION['user_id'])) { //username
  header('Location: ../index.php');
  exit();
}

include('../config/config_unv.php');

$sql = "SELECT * FROM contacts"; // Assurez-vous que 'contacts' est le bon nom de table
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulter les Contacts</title>
  <link rel="stylesheet" href="../css/style-contacts.css">

  <style>
    th {
      border: 1px solid blue;
      padding: 5px;
      margin: 10px;

      background-color: #2A7E50;/*#f2f2f2*/
      color: #f1f1f1;/*#333*/
    }

    td {
      padding: 5px;
      border: 1px solid blue;
      margin: 10px;
    }

    /*h1 {
      text-align: center;
    }
    /* Styles pour les écrans de bureau (grands écrans) *//*
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 18px;
      text-align: left;

      font-size: 14px;
    }*/

    th,
    td {
      padding: 12px;
      border: 1px solid #ddd;
      border: 1px solid grey;
    }

    /*th {
      background-color: #f2f2f2;
      color: #333;
    }*/

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    /* Styles pour les petits écrans (smartphones et tablettes) *//*
    @media (max-width: 768px) {
      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      th {
        display: none;
        /* On masque les en-têtes pour les petits écrans *//*
      }

      tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
      }

      /*body {
        font-size: 16px; /* Taille globale plus lisible *//*
      }*/

     /* td {
        /*font-size: 26px; /* Plus gros sur mobile *//*
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ddd;
      }*/

      /*td::before {
        content: attr(data-label);
        /* Utilisation de l'attribut data-label pour afficher le titre de la colonne *//*
        font-weight: bold;
        text-transform: uppercase;
        margin-right: 10px;
        /*font-size: 14px; /* tu peux ajuster aussi ça si besoin *//*
      }**//*
    }*/

  </style>

<!--@media (max-width: 768px) {
  body {
    font-size: 16px; /* Taille globale plus lisible */
  }

  td {
    font-size: 16px; /* Plus gros sur mobile */
    display: flex;
    justify-content: space-between;
    padding: 12px;
    border: none;
    border-bottom: 1px solid #ddd;
  }

  td::before {
    content: attr(data-label);
    font-weight: bold;
    text-transform: uppercase;
    margin-right: 10px;
    font-size: 14px; /* tu peux ajuster aussi ça si besoin */
  }
}-->

<style>
  /* Par défaut */
body {
  font-size: 16px;/* Taille globale plus lisible */
}

.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 0 15px;
}

h1 {
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 14px;
}

th, td {
  padding: 12px;
  border: 1px solid #ddd;
}

/* Responsive pour petits écrans */
@media (max-width: 768px) {
  body {
    font-size: 16px;
  }

  table, thead, tbody, th, td, tr {
    display: block;
  }

  thead {
    display: none;
  }

  tr {
    margin-bottom: 15px;
    border-bottom: 2px solid #ccc;
  }

  td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    font-size: 16px;/* Plus gros sur mobile */
    border: none;
    border-bottom: 1px solid #ddd;
  }

  td::before {
    content: attr(data-label);/* Utilisation de l'attribut data-label pour afficher le titre de la colonne */
    font-weight: bold;
    text-transform: uppercase;
    margin-right: 10px;
    font-size: 14px;/* tu peux ajuster aussi ça si besoin */
    color: #333;
  }
}
</style>

</head>

<body>
  <header>
    <h1>Liste des Contacts</h1>
  </header>
  <main>
     <div class="container">
    <table>
      <thead>
        <tr>
          <!--<th>ID</th>-->
          <!--<th>Prenom</th>-->
          <th>Nom</th> 
          <th>Email</th>
          <!--<th>Téléphone-->
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $contact) : ?>
          <tr>
            <!--<td data-label="Nom"><!?php echo htmlspecialchars($contact['id']); ?></td>-->
            <!--<td data-label="Nom"><!?php echo htmlspecialchars($contact['prenom']); ?></td>-->
            <td data-label="Nom"><?php echo htmlspecialchars($contact['nom']); ?></td><!--name-->
            <td data-label="Email"><?php echo htmlspecialchars($contact['email']); ?></td>
            <!--<td data-label="Nom"><!?php echo htmlspecialchars($contact['telephone']); ?></td>-->
            <td data-label="Message"><?php echo htmlspecialchars($contact['message']); ?></td>


<td>
  <form method="post" action="marquer-traite.php">
    <input type="hidden" name="contact_id" value="<?= $contact['id']; ?>">
    <button type="submit">Marquer comme traité</button>
  </form>
</td>

          </tr>
        <?php endforeach; ?>




      </tbody>
    </table>
    </div>
  </main>
</body>

</html>