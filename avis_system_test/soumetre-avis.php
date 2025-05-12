<?php
session_start();
require_once '../config/config_unv.php';

// Vérifie la méthode
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Méthode non autorisée.");
}

// 1. CSRF token
if (
  empty($_POST['csrf_token']) ||
  $_POST['csrf_token'] !== $_SESSION['csrf_token']
) {
  die("Erreur CSRF : requête non autorisée.");
}

// 2. Honeypot
if (!empty($_POST['website'])) {
  die("Bot détecté.");
}

// 3. Limite d'envoi par IP
$ip = $_SERVER['REMOTE_ADDR'];
$now = time();

if (!isset($_SESSION['avis_last_submit'])) {
  $_SESSION['avis_last_submit'] = [];
}

if (isset($_SESSION['avis_last_submit'][$ip]) && $now - $_SESSION['avis_last_submit'][$ip] < 120) {
  die("Trop de soumissions. Réessayez dans 2 minutes.");
}

$_SESSION['avis_last_submit'][$ip] = $now;

// 4. Récupération et nettoyage des données
$nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

if (empty($nom) || empty($message)) {
  die("Veuillez remplir tous les champs.");
}

// 5. Insertion sécurisée "Requête SQL"
try {
  $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
  $stmt->execute([
    ':auteur' => $nom,
    ':message' => $message
  ]);

  header("Location: ./merci.html"); //thank_you_avis.php
  exit;

} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>












<!--?php
session_start();
require_once '../config/config_unv.php';

// Vérification des sessions (on peut ajouter des erreurs pour vérifier la bonne initialisation)
if (session_status() !== PHP_SESSION_ACTIVE) {
  die("Erreur de session : la session n'est pas correctement activée.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1. Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur CSRF détectée.");
  }

  // 2. Vérification CAPTCHA
  // Vérification stricte du CAPTCHA : on ignore les espaces avant et après la saisie
  if (!isset($_POST['captcha']) || trim($_POST['captcha']) !== $_SESSION['captcha']) {
    die("Captcha invalide.");
  }

  // 3. Nettoyage des champs (XSS + trim)
  $nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

  // 4. Vérification de contenu
  if (!empty($nom) && !empty($message)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
      $stmt->execute([
        ':auteur' => $nom,
        ':message' => $message
      ]);
      // Nettoyage session CSRF et CAPTCHA
      unset($_SESSION['csrf_token'], $_SESSION['captcha']);
      header("Location: ./thank_you_avis.php");
      exit;
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
    }
  } else {
    echo "Champs requis manquants.";
  }
} else {
  echo "Méthode non autorisée.";
}

// Débogage : Afficher les informations de la session
echo "<h2>Débogage de la session et du CAPTCHA</h2>";
echo "<pre>";
print_r($_SESSION); // Afficher toutes les informations de la session pour comprendre ce qui est stocké
echo "</pre>";

// Affichage des valeurs pour le débogage
echo "Valeur CAPTCHA dans la session : " . $_SESSION['captcha'] . "<br>";
echo "Valeur CAPTCHA saisie : " . htmlspecialchars($_POST['captcha']) . "<br>";
?>

------------------>



<!--?php
session_start();
require_once '../config/config_unv.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1. Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur CSRF détectée.");
  }

  // 2. Vérification CAPTCHA
  // Vérification stricte du CAPTCHA : on ignore les espaces avant et après la saisie
  if (!isset($_POST['captcha']) || trim($_POST['captcha']) !== $_SESSION['captcha']) {
    die("Captcha invalide.");
  }

  // 3. Nettoyage des champs (XSS + trim)
  $nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

  // 4. Vérification de contenu
  if (!empty($nom) && !empty($message)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
      $stmt->execute([
        ':auteur' => $nom,
        ':message' => $message
      ]);
      // Nettoyage session CSRF et CAPTCHA
      unset($_SESSION['csrf_token'], $_SESSION['captcha']);
      header("Location: ./thank_you_avis.php");
      exit;
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
    }
  } else {
    echo "Champs requis manquants.";
  }
} else {
  echo "Méthode non autorisée.";
}

// Debug : Afficher la valeur CAPTCHA dans la session et la valeur saisie
echo "Valeur CAPTCHA dans la session: " . $_SESSION['captcha']; // Debug
echo "<br>";
echo "Valeur CAPTCHA saisie : " . htmlspecialchars($_POST['captcha']); // Debug

// Afficher la session complète pour vérifier les valeurs stockées
echo "<pre>";
print_r($_SESSION); // Debug
echo "</pre>";
?>
------------------->


<!--?php
session_start();
require_once '../config/config_unv.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1. Vérification CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur CSRF détectée.");
  }

  // 2. Vérification CAPTCHA
  if (!isset($_POST['captcha']) || $_POST['captcha'] !== $_SESSION['captcha']) {
    die("Captcha invalide.");
  }

  // 3. Nettoyage des champs (XSS + trim)
  $nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

  // 4. Vérification de contenu
  if (!empty($nom) && !empty($message)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
      $stmt->execute([
        ':auteur' => $nom,
        ':message' => $message
      ]);
      // Nettoyage session CSRF et CAPTCHA
      unset($_SESSION['csrf_token'], $_SESSION['captcha']);
      header("Location: ./thank_you_avis.php");
      exit;
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
    }
  } else {
    echo "Champs requis manquants.";
  }
} else {
  echo "Méthode non autorisée.";
}

// Ajoute cette ligne pour déboguer et afficher la valeur CAPTCHA dans la session
echo "Valeur CAPTCHA dans la session: " . $_SESSION['captcha']; // Debug

// Ajoute ceci pour afficher l'ensemble de la session afin de déboguer
echo "<pre>";
print_r($_SESSION); // Debug
echo "</pre>";
?>

-------------->






<!--?php
session_start();
require_once '../config/config_unv.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1. Vérif CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Erreur CSRF détectée.");
  }

  // 2. Vérif CAPTCHA
  if (!isset($_POST['captcha']) || $_POST['captcha'] !== $_SESSION['captcha']) {
    die("Captcha invalide.");
  }

  // 3. Nettoyage des champs (XSS + trim)
  $nom = htmlspecialchars(trim($_POST['auteur']), ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

  // 4. Vérification de contenu
  if (!empty($nom) && !empty($message)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO avis (auteur, message, statut) VALUES (:auteur, :message, 'en_attente')");
      $stmt->execute([
        ':auteur' => $nom,
        ':message' => $message
      ]);
      // Nettoyage session CSRF et CAPTCHA
      unset($_SESSION['csrf_token'], $_SESSION['captcha']);
      header("Location: ./thank_you_avis.php");
      exit;
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
    }
  } else {
    echo "Champs requis manquants.";
  }
} else {
  echo "Méthode non autorisée.";
}

// Ajoute cette ligne dans soumetre-avis.php pour déboguer
echo "Valeur CAPTCHA dans la session: " . $_SESSION['captcha']; // Debug

/*
🔐 Résumé après amélioration :
Risque	État actuel	Recommandation
SQL Injection	✅ Sécurisé	OK (requêtes préparées)
XSS	✅ Sécurisé	Encodage à l’insertion et à l’affichage
CSRF	✅ Sécurisé	Token CSRF en place
Force Brute / Spam	✅ Basique OK	CAPTCHA simple
*/
