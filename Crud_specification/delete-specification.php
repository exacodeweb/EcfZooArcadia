<?php
require_once '../config/config_unv.php';

if (isset($_GET['id'])) {
    $spec_id = intval($_GET['id']);  // Récupérer l'ID depuis l'URL

    // Vérifier que l'ID est valide et exécuter la suppression
    if ($spec_id > 0) {
        // Supprimer la spécification de la base de données
        $sql = "DELETE FROM specifications WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$spec_id]);

        // Rediriger vers la page de gestion après la suppression
        header("Location: manage-specifications.php");
        exit();  // Arrêter le script après la redirection
    } else {
        echo "ID invalide.";
    }
} else {
    echo "ID manquant.";
}
?>















<!--?php
require_once '../config/config_unv.php';

if (isset($_GET['id'])) {
    $spec_id = intval($_GET['id']);

    // Supprimer la spécification
    $sql = "DELETE FROM specifications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$spec_id]);

    // Redirection après suppression (avant tout texte ou message)
    header("Location: manage-specifications.php");
    exit();  // Ajoutez exit pour arrêter l'exécution du script après la redirection
} else {
    // Afficher un message d'erreur sans envoyer de sortie avant la redirection
    echo "Spécification supprimée avec succès !";
    header("Location: manage-specifications.php?error=1");
    exit();
}
?>
-->
