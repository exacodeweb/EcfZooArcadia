<?php
require_once '../config/config_unv.php';

// Récupération et sécurisation des données du formulaire
$nom = $_POST['nom_visiteur'] ?? '';
$email = $_POST['email'] ?? '';
$date_reservation = $_POST['date_visite'] ?? '';
$service_id = $_POST['service_id'] ?? '';
$nb_adultes = (int) ($_POST['nb_adultes'] ?? 0);
$nb_enfants = (int) ($_POST['nb_enfants'] ?? 0);
$nb_etudiants = (int) ($_POST['nb_etudiants'] ?? 0);

try {
    // === Requête préparée n°1 : Vérification des doublons === // 1. Vérification des doublons
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE service_id = ? AND date_reservation = ?");
    $stmt->execute([$service_id, $date_reservation]);
    $existingReservations = $stmt->fetchColumn();

    if ($existingReservations > 0) {
        throw new Exception("Il y a déjà une réservation pour cette date et ce type de visite.");
    }

     //  Vérification des données (sans requête préparée) // 2. Vérification des données
    if ($nb_adultes < 0 || $nb_enfants < 0 || $nb_etudiants < 0) {
        throw new Exception("Le nombre de billets ne peut pas être négatif.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("L'email fourni est invalide.");
    }

    // === Requête préparée n°2 : Récupération des prix du type de visite === // 3. Récupération des prix du type de visite
    $stmt = $pdo->prepare("SELECT id, prix_adulte, prix_enfant, prix_etudiant, nom_type FROM types_visite WHERE id = ?");
    $stmt->execute([$service_id]);
    $typeVisite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$typeVisite) {
        throw new Exception("Le type de visite sélectionné est introuvable.");
    }

    // Calcul du prix total (sans requête préparée) // 4. Calcul du prix total
    $total_prix = (
        $nb_adultes * $typeVisite['prix_adulte'] +
        $nb_enfants * $typeVisite['prix_enfant'] +
        $nb_etudiants * $typeVisite['prix_etudiant']
    );

    // === Requête préparée n°3 : Insertion dans la base === // 5. Insertion dans la base
    $sql = "INSERT INTO reservations 
            (service_id, date_reservation, nom, email, nb_adultes, nb_enfants, nb_etudiants, total_prix, statut) 
            VALUES 
            (:service_id, :date_reservation, :nom, :email, :nb_adultes, :nb_enfants, :nb_etudiants, :total_prix, :statut)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':service_id' => $typeVisite['id'],
        ':date_reservation' => $date_reservation,
        ':nom' => $nom,
        ':email' => $email,
        ':nb_adultes' => $nb_adultes,
        ':nb_enfants' => $nb_enfants,
        ':nb_etudiants' => $nb_etudiants,
        ':total_prix' => $total_prix,
        ':statut' => 'en_attente'
    ]);

    // Envoi de l'email de confirmation (sans requête préparée) // 6. Envoi de l'email de confirmation
    $to = $email;
    $subject = "Confirmation de votre réservation - Zoo Arcadia";
    $message = "
    Bonjour $nom,

    Votre réservation pour le $date_reservation a bien été enregistrée.

    Détails :
    Type de visite : " . htmlspecialchars($typeVisite['nom_type']) . "
    Nombre d'adultes : $nb_adultes
    Nombre d'enfants : $nb_enfants
    Nombre d'étudiants : $nb_etudiants
    Prix total : $total_prix €

    Merci et à bientôt au Zoo Arcadia !

    Cordialement,
    L'équipe du Zoo Arcadia
    ";
    $headers = 'From: no-reply@yopmail.com' . "\r\n" .//From: no-reply@zooarcadia.com
               'Reply-To: no-reply@yopmail.com' . "\r\n" .//Reply-To: no-reply@zooarcadia.com
               'Content-Type: text/plain; charset=utf-8' . "\r\n";//Test : bicrelleugroimmo-5970@yopmail.com et zoo.arcadia-5970@yopmail.com

    if (!mail($to, $subject, $message, $headers)) {
        throw new Exception("Erreur lors de l'envoi de l'email de confirmation.");
    }

    // 7. Redirection vers la page de confirmation
    header("Location: confirmation.php?success=1");
    exit;

} catch (Exception $e) {
    echo "Erreur lors de la réservation : " . $e->getMessage();
}

?>










<!--?php
require_once '../config/config_unv.php';
//$pdo = getPDO();

// Récupération et sécurisation des données du formulaire
$nom = $_POST['nom_visiteur'] ?? '';
$email = $_POST['email'] ?? '';
$date_reservation = $_POST['date_visite'] ?? '';
$service_id = $_POST['service_id'] ?? '';
$nb_adultes = (int) ($_POST['nb_adultes'] ?? 0);
$nb_enfants = (int) ($_POST['nb_enfants'] ?? 0);
$nb_etudiants = (int) ($_POST['nb_etudiants'] ?? 0);

try {
    // 1. Vérifier si le service existe et récupérer les bons prix
    $stmt = $pdo->prepare("SELECT id, prix_adulte, prix_enfant, prix_etudiant FROM types_visite WHERE id = ?");
    $stmt->execute([$service_id]);
    $typeVisite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$typeVisite) {
        throw new Exception("Le type de visite sélectionné est introuvable.");
    }

    // 2. Calcul du prix total
    $total_prix = (
        $nb_adultes * $typeVisite['prix_adulte'] +
        $nb_enfants * $typeVisite['prix_enfant'] +
        $nb_etudiants * $typeVisite['prix_etudiant']
    );

    // 3. Insertion de la réservation dans la base
    $sql = "INSERT INTO reservations 
            (service_id, date_reservation, nom, email, nb_adultes, nb_enfants, nb_etudiants, total_prix, statut) 
            VALUES 
            (:service_id, :date_reservation, :nom, :email, :nb_adultes, :nb_enfants, :nb_etudiants, :total_prix, :statut)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':service_id' => $typeVisite['id'],
        ':date_reservation' => $date_reservation,
        ':nom' => $nom,
        ':email' => $email,
        ':nb_adultes' => $nb_adultes,
        ':nb_enfants' => $nb_enfants,
        ':nb_etudiants' => $nb_etudiants,
        ':total_prix' => $total_prix,
        ':statut' => 'en_attente'
    ]);

    // 4. Redirection ou confirmation
    header("Location: confirmation.php?success=1");
    exit;

} catch (Exception $e) {
    echo "Erreur lors de la réservation : " . $e->getMessage();
}






