<?php
// Classe pour gérer les contacts dans la base de données
class Contact {
    private $pdo;
    // Constructeur avec injection de PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Ajoute une nouvelle demande de contact dans la BDD
    public function ajouterContact($nom, $email, $message) {
        $sql = "INSERT INTO contacts (nom, email, message) VALUES (:nom, :email, :message)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }
}
?>



<!--?php
class Contact {//Avis
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterAvis($nom, $email, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO contacts (nom, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $message]);
    }
}
?>

-->





<!-- 

✅ Conclusion : Comment centraliser et structurer un projet comme un pro ?
1️⃣ Créer un dossier /config/ pour stocker la configuration (database.php, .env).
2️⃣ Créer un dossier /models/ pour gérer les accès aux données (ex: User.php).
3️⃣ Créer un dossier /controllers/ pour traiter les formulaires et gérer la logique.
4️⃣ Créer un dossier /views/ pour afficher les pages HTML/PHP.
5️⃣ Inclure les fichiers nécessaires (require_once) pour éviter la duplication.
6️⃣ Utiliser un fichier .env pour stocker les identifiants de la base de données.
7️⃣ Séparer le code en Modèle / Vue / Contrôleur (MVC) pour un projet propre et maintenable.

💡 Si on appliques ces principes, le projet sera organisé et facile à maintenir ! 🚀



/avis_system_test/   
│── /views/                  # Pages affichées aux utilisateurs
│   ├── soumetre-avis.html   # Formulaire d'avis
│── /controllers/            # Gestion des actions et des formulaires
│   ├── soumettre-avis.php   # Traitement du formulaire
│── /models/                 # Gestion de la base de données
│   ├── Avis.php   contact.php          # Modèle de gestion des avis
│── /config/                 # Configuration du projet
│   ├── database.php         # Connexion à la base de données
│── index.php                # Page d'accueil du site

-->


