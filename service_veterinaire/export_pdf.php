<!-- Ajout de l'Export PDF (export_pdf.php)
Installe FPDF si ce n'est pas déjà fait :

bash
Copier
Modifier
composer require setasign/fpdf -->

<?php
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé
require '../vendor/autoload.php';

use FPDF\FPDF;

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, 'Historique des Comptes-Rendus', 1, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'C');
    }
}

// Récupération des données
$veterinaire_id = isset($_POST['veterinaire_id']) ? $_POST['veterinaire_id'] : '';

$sql = "SELECT c.animal_id, a.nom AS nom_animal, c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, u.nom AS veterinaire 
        FROM rapports_veterinaires c
        JOIN utilisateurs u ON c.veterinaire_id = u.id
        JOIN animaux a ON c.animal_id = a.id";

if (!empty($veterinaire_id)) {
    $sql .= " WHERE c.veterinaire_id = :veterinaire_id";
}

$sql .= " ORDER BY c.date_visite DESC";
$query = $pdo->prepare($sql);

if (!empty($veterinaire_id)) {
    $query->bindParam(':veterinaire_id', $veterinaire_id, PDO::PARAM_INT);
}

$query->execute();
$comptes_rendus = $query->fetchAll();

// Génération du PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

foreach ($comptes_rendus as $c) {
    $pdf->Cell(30, 10, 'Animal: '.$c['nom_animal'], 0, 1);
    $pdf->Cell(30, 10, 'Date: '.date('d/m/Y', strtotime($c['date_visite'])), 0, 1);
    $pdf->Cell(30, 10, 'Vétérinaire: '.$c['veterinaire'], 0, 1);
    $pdf->MultiCell(0, 10, 'Détails: '.$c['detail_etat']);
    $pdf->Ln(5);
}

$pdf->Output('D', 'Comptes_Rendus.pdf');









