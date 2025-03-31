<?php
session_start();
//require_once('../public/utilise.php'); // Connexion BDD
require_once '../config/config_unv.php'; // a testé

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['role'])) {
        $_SESSION['message'] = ["type" => "danger", "text" => "Tous les champs sont requis !"];
        header("Location: ./modif-employe.php?id=" . $_POST['id']);//modif-employe
        exit;
    }

    // Sécuriser les entrées
    $id = intval($_POST['id']);
    $id = 3; // Mets un ID qui existe dans ta base

    //Ajoutez cette ligne après intval($_GET['id']); pour vérifier l'ID reçu :
    var_dump($id=3);
    exit;

    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $role = $_POST['role'];

    if (!$email) {
        $_SESSION['message'] = ["type" => "danger", "text" => "Adresse email invalide !"];
        header("Location: ./modif-employe.php?id=" . $id);//modif-employe
        exit;
    }

    try {
        $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $role, $id]);

        $_SESSION['message'] = ["type" => "success", "text" => "L'employé a été modifié avec succès !"];
    } catch (PDOException $e) {
        $_SESSION['message'] = ["type" => "danger", "text" => "Erreur lors de la modification : " . $e->getMessage()];
    }
    header("Location: ./modif-employe.php?id=" . $id);//modif-employe
    exit;
  }
?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']['text'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Modifier un employé</h2>
            <form action="traitement-modif.php" method="POST" class="row g-3">
                <input type="hidden" name="id" value="<?= $employe['id'] ?>">

                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($employe['nom']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($employe['prenom']) ?>" required>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employe['email']) ?>" required>
                </div>

                <div class="col-12">
                    <label for="role" class="form-label">Rôle :</label>
                    <select name="role" class="form-select" required>
                        <option value="employe" <?= $employe['role'] == 'employe' ? 'selected' : '' ?>>Employé</option>
                        <option value="veterinaire" <?= $employe['role'] == 'veterinaire' ? 'selected' : '' ?>>Vétérinaire</option>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-between">
                    <a href="liste.php" class="btn btn-secondary">🔙 Retour</a>
                    <button type="submit" class="btn btn-primary">💾 Modifier</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
