<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../config/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center">Ajouter un Employé</h2>
                    <form action="traitement-ajout-employe.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Statut :</label><!-- Nom -->
                            <input type="text" name="nom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prénom :</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        


                        <div class="mb-3">
                            <label class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe :</label>
                            <input type="password" name="mot_de_passe" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rôle :</label>
                            <select name="role" class="form-select" required>
                                <option value="employe">Employé</option>
                                <option value="veterinaire">Vétérinaire</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ajouter l'employé</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>











<!--?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../config/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Employé</title>
</head>
<body>
    <h1>Ajouter un Employé</h1>
    <form action="./traitement-ajout-employe.php" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required><br>

        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="employe">Employé</option>
            <option value="admin">Administrateur</option>
            <option value="veterinaire">équipe-médicale</option>
        </select><br>

        <input type="submit" value="Ajouter l'Employé">
    </form>
</body>
</html>