
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = new PDO('mysql:host=localhost;dbname=zoo_arcadia;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les valeurs
    $nom = $_POST['nom_visiteur'];
    $email = $_POST['email'];
    $date = $_POST['date_visite'];
    $type = $_POST['type_visite'];
    $adultes = (int)$_POST['nb_adultes'];
    $enfants = (int)$_POST['nb_enfants'];
    $etudiants = (int)$_POST['nb_etudiants'];

    // Prix par type de billet
    $stmt = $pdo->prepare("SELECT * FROM types_visite WHERE nom_type = ?");
    $stmt->execute([$type]);
    $infosTarifs = $stmt->fetch();

    if (!$infosTarifs) {
        die("Type de visite non valide.");
    }

    $prixTotal = ($adultes * $infosTarifs['prix_adulte']) +
                 ($enfants * $infosTarifs['prix_enfant']) +
                 ($etudiants * $infosTarifs['prix_etudiant']);

    // Insertion
    $stmt = $pdo->prepare("INSERT INTO reservations 
        (nom_visiteur, email, date_visite, type_visite, nb_adultes, nb_enfants, nb_etudiants, total_prix) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([$nom, $email, $date, $type, $adultes, $enfants, $etudiants, $prixTotal]);

    echo "<h2>Merci pour votre réservation !</h2>";
    echo "<p>Un e-mail de confirmation vous sera envoyé sous peu.</p>";
    echo "<p>Montant total : " . number_format($prixTotal, 2) . " €</p>";
} else {
    echo "Méthode non autorisée.";
}