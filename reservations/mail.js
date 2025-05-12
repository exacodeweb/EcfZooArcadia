
$to = $email;// Envoi de l'email de confirmation
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
$headers = 'From: no-reply@yopmail.com' . "\r\n" .//no-reply@zooarcadia.com
           'Reply-To: no-reply@yopmail.com' . "\r\n" .//no-reply@zooarcadia.com
           'Content-Type: text/plain; charset=utf-8' . "\r\n";

if (!mail($to, $subject, $message, $headers)) {
    throw new Exception("Erreur lors de l'envoi de l'email de confirmation.");
}
