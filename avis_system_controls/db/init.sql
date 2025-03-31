CREATE TABLE Avis (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  dateSoumission DATETIME DEFAULT CURRENT_TIMESTAMP,
  statut ENUM('en_attente', 'approuve') DEFAULT 'en_attente'
);












CREATE DATABASE IF NOT EXISTS avis_system;
USE avis_system;

CREATE TABLE avis (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message TEXT NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  statut ENUM('en_attente', 'valide') DEFAULT 'en_attente',
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO avis (message, auteur, statut) VALUES
('Une expérience incroyable !', 'Jean Dupont-C', 'valide'),
('Le zoo est bien entretenu.', 'Marie Curie', 'valide'),
('Un endroit parfait pour la famille.', 'Albert Einstein', 'valide'),
('Un accueil chaleureux.', 'Isaac Newton', 'en_attente');

