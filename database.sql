-- Base de données pour DKM Auto
CREATE DATABASE IF NOT EXISTS dkm_auto;
USE dkm_auto;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    role ENUM('admin', 'user') DEFAULT 'user',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('actif', 'inactif') DEFAULT 'actif'
);

-- Table des services
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix_min DECIMAL(10,2),
    prix_max DECIMAL(10,2),
    image_url VARCHAR(255),
    categorie VARCHAR(50),
    statut ENUM('actif', 'inactif') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des équipes
CREATE TABLE equipe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    poste VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    email VARCHAR(100),
    telephone VARCHAR(20),
    statut ENUM('actif', 'inactif') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des partenaires
CREATE TABLE partenaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    logo_url VARCHAR(255),
    site_web VARCHAR(255),
    email VARCHAR(100),
    telephone VARCHAR(20),
    statut ENUM('actif', 'inactif') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des rendez-vous
CREATE TABLE rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    vehicule VARCHAR(100),
    service_id INT,
    service_nom VARCHAR(100),
    date_rdv DATE NOT NULL,
    heure_rdv TIME NOT NULL,
    message TEXT,
    urgence ENUM('normale', 'urgente', 'tres-urgente') DEFAULT 'normale',
    statut ENUM('en_attente', 'confirme', 'annule', 'termine') DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- Table des messages de contact
CREATE TABLE messages_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sujet VARCHAR(200),
    message TEXT NOT NULL,
    statut ENUM('non_lu', 'lu', 'repondu') DEFAULT 'non_lu',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des données de base

-- Admin par défaut
INSERT INTO users (nom, email, password, role) VALUES 
('Admin DKM', 'admin@dkmauto.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Services
INSERT INTO services (nom, description, prix_min, prix_max, image_url, categorie) VALUES 
('Changement d\'huile', 'Service rapide et professionnel pour maintenir votre moteur en parfait état. Huile de qualité et filtre inclus.', 29.99, 89.99, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'entretien'),
('Alignement', 'Alignement précis pour une conduite sécuritaire et confortable. Équipement moderne et réglage précis.', 39.99, 129.99, 'https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'mecanique'),
('Carrosserie & Aluminium', 'Réparations et transformations de carrosserie professionnelles. Travail aluminium et réparations diverses.', 0, 0, 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'carrosserie'),
('Diagnostic Électronique', 'Diagnostic précis des problèmes électroniques de votre véhicule. Équipement OBD2 et rapport détaillé.', 49.99, 149.99, 'https://images.unsplash.com/photo-1563720223185-11003d516935?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'electronique'),
('Moteurs & Transmissions', 'Réparation et entretien des moteurs et transmissions. Expertise technique et garantie étendue.', 0, 0, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'mecanique'),
('Vente de Pièces', 'Large gamme de pièces automobiles de qualité. Pièces neuves et partenaires NextPart et Pièces Économiques.', 0, 0, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'pieces');

-- Équipe
INSERT INTO equipe (nom, poste, description, image_url, email, telephone) VALUES 
('Mohammed Zwawi', 'Propriétaire & Mécanicien Principal', 'Fondateur de DKM Auto avec plus de 15 ans d\'expérience en mécanique automobile. Spécialiste en diagnostic et réparation de moteurs.', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'mohammed@dkmauto.com', '(418) 555-0101'),
('Jean-Pierre Tremblay', 'Mécanicien Senior', 'Expert en systèmes de freinage et suspension. Plus de 10 ans d\'expérience dans la réparation automobile.', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'jp@dkmauto.com', '(418) 555-0102'),
('Marie-Claude Dubois', 'Mécanicienne & Conseillère', 'Spécialiste en diagnostic électronique et systèmes modernes. Formée aux dernières technologies automobiles.', 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'marie@dkmauto.com', '(418) 555-0103');

-- Partenaires
INSERT INTO partenaires (nom, description, logo_url, site_web, email, telephone) VALUES 
('NextPart', 'Partenaire officiel pour pièces automobiles de qualité. Large gamme de pièces neuves et garanties.', 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'https://nextpart.ca', 'contact@nextpart.ca', '1-800-NEXTPART'),
('Pièces Économiques', 'Franchise acquise - image de marque propre. Pièces automobiles à prix compétitifs avec garantie.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'https://pieceseconomiques.ca', 'info@pieceseconomiques.ca', '1-800-PIECES'),
('Castrol', 'Huiles et lubrifiants de qualité professionnelle. Partenaire technique pour nos services d\'entretien.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'https://castrol.com', 'contact@castrol.ca', '1-800-CASTROL'),
('Bosch', 'Équipements de diagnostic et pièces de qualité. Partenaire technique pour nos diagnostics électroniques.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80', 'https://bosch.com', 'info@bosch.ca', '1-800-BOSCH'); 