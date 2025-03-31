<?php

//require '../config/config_parrot.php';//test
require '../config/config_unv.php';

function connectDB() {

    //$config = require '../config/config_parrot.php';//test
    $config = require '../config/config_unv.php';

    $db_config = $config['db'];
    try {
        $pdo = new PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}",
            $db_config['user'],
            $db_config['pass']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM users2 WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo "Compte employé supprimé avec succès.";
}
?>

<!-------------------------------------------------------->
<!--  script pour traiter la suppression d'un employé : -->
<!-------------------------------------------------------->