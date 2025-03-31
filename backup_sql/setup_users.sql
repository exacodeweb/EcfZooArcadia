-- Créer l'utilisateur MySQL
CREATE USER 'utilisateur_zoo'@'localhost' IDENTIFIED BY 'Z00_Arcadia!2024';

-- Lui donner les droits sur la base de données
GRANT ALL PRIVILEGES ON zoo_arcadia.* TO 'utilisateur_zoo'@'localhost';

-- Appliquer les modifications
FLUSH PRIVILEGES;
