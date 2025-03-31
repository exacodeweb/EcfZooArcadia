
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services - Zoo Arcadia</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Styles adaptés aux services */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin: 20px 0;
        }

        .services-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .service {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .service:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .service img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service h3 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        .service p {
            font-size: 1em;
            padding: 0 10px 10px;
            color: #555;
        }


        /* Bouton de détails */
        .btn-details {
            display: inline-block;
            margin: 10px 0 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .btn-details:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .services-list {
                flex-direction: column;
                align-items: center;
            }

            .service {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<?php
// Inclure et récupérer l'objet PDO
// $pdo = include '../config/config.php';
include '../includes/db-connection.php';

try {
    // Récupérer tous les services
    $sql = "SELECT * FROM services";
    $stmt = $pdo->query($sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des services : " . $e->getMessage());
}
?>

    <h1>Nos Services</h1>
    <div class="services-list">
        <?php foreach ($services as $service): ?>
            <div class="service">

                <!--<img src="/assets/images/<!?= htmlspecialchars($service['image']) ?>" alt="<!?= htmlspecialchars($service['nom']) ?>">-->
        <!--<img src="../assets/images/<!?= htmlspecialchars($service['image'] ?: 'default.jpg') ?>" alt="<!?= htmlspecialchars($service['nom']) ?>">-->
                <!--<img src="../assets/images/<!?= htmlspecialchars($service['images']) ?>" alt="<!?= htmlspecialchars($service['nom']) ?>">-->
                
                <img src="../assets/images/<?= htmlspecialchars($service['images']) ?>?v=<?= time() ?>" 
                alt="<?= htmlspecialchars($service['nom']) ?>" onerror="this.src='../assets/images/default.jpg';">

                <h3><?= htmlspecialchars($service['nom']) ?></h3>
                <p><?= htmlspecialchars($service['description']) ?></p>
                <a href="details-habitat.php?id=<?= $habitat['id'] ?>" class="btn-details">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>







<!--?php
include '../includes/db-connection.php';

try {
    // Récupérer tous les services
    $sql = "SELECT nom, description, images FROM services";
    $stmt = $pdo->query($sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des services : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services - Zoo Arcadia</title>
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        /* Styles adaptés aux services */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin: 20px 0;
        }

        .services-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .service {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .service:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .service img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service h3 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        .service p {
            font-size: 1em;
            padding: 0 10px 10px;
            color: #555;
        }

        @media (max-width: 768px) {
            .services-list {
                flex-direction: column;
                align-items: center;
            }

            .service {
                width: 90%;
            }
        }
    </style>

</head>
<body>
    <h1>Nos Services</h1>
    <div class="services-list">
        <!?php foreach ($services as $service): ?>
            <div class="service">
                <img src="../assets/images/<!?= htmlspecialchars($service['images'] ?: 'default.jpg') ?>" 
                     alt="<!?= htmlspecialchars($service['nom']) ?>" 
                     onerror="this.src='../assets/images/default.jpg';">
                <h3><!?= htmlspecialchars($service['nom']) ?></h3>
                <p><!?= htmlspecialchars($service['description']) ?></p>
            </div>
        <!?php endforeach; ?>
    </div>
</body>
</html>




