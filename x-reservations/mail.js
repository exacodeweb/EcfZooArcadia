// Envoi de l'email de confirmation
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
$headers = 'From: no-reply@zooarcadia.com' . "\r\n" .
           'Reply-To: no-reply@zooarcadia.com' . "\r\n" .
           'Content-Type: text/plain; charset=utf-8' . "\r\n";

if (!mail($to, $subject, $message, $headers)) {
    throw new Exception("Erreur lors de l'envoi de l'email de confirmation.");
}
