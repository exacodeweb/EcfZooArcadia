<?php
session_start();

// Génération du jeton CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_dashboard.php"); // Rediriger vers le tableau de bord
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="login_essai.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>












<!--
<form method="POST" action="">
    <h1>Connexion</h1>
    <!?php if (!empty($error)): ?>
        <p class="error-message"><!?php echo $error; ?></p>
    <!?php endif; ?>
    <div class="champ">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="Entrez votre email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
    -->




<!--?php
session_start();

// Génération du jeton CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: ./pages/admin_dashboard.php"); // Rediriger vers le tableau de bord
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    
    <!?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><!?php echo htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?></p>
        <!?php unset($_SESSION['error']); ?>
    <!?php endif; ?>

    <form action="process_login_essai.php" method="POST">
        <input type="hidden" name="csrf_token" value="<!?php echo $_SESSION['csrf_token']; ?>">
        
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
