<?php
session_start();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    //header("Location: ../config/login.php");
    header("Location: ../config/config_unv.php");
    exit;
}

// Optionnel : régénérer l'ID de session pour éviter le fixation de session
session_regenerate_id(true);
?>





<!--?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../config/login.php");
    exit;
}
?>-->



<!--?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../config/login.php");
    exit;
}

// Générer un ID de session unique pour éviter l’écrasement
session_regenerate_id(true);

// Générer un token de session unique
if (!isset($_SESSION['session_token'])) {
    $_SESSION['session_token'] = bin2hex(random_bytes(32));
}

// Définir un cookie pour identifier la session de cet utilisateur
setcookie("session_token_" . $_SESSION['user_id'], $_SESSION['session_token'], time() + 3600, "/");
?>