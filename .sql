-- Table des espèces (Species)
CREATE TABLE Species (
    id INT AUTO_INCREMENT PRIMARY KEY,
    species VARCHAR(50) NOT NULL
);

-- Table des habitats (Habitats)
CREATE TABLE Habitats (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    img VARCHAR(255) DEFAULT NULL,
    description TEXT,
    commentaire TEXT DEFAULT NULL
);

-- Table des animaux (Animals)
CREATE TABLE Animals (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    species_id INT(11),
    img VARCHAR(255) DEFAULT NULL,
    habitat_id INT(11),
    CONSTRAINT fk_animals_species FOREIGN KEY (species_id) REFERENCES Species(id) ON DELETE SET NULL,
    CONSTRAINT fk_animals_habitat FOREIGN KEY (habitat_id) REFERENCES Habitats(id) ON DELETE SET NULL
);

-- Table des rôles (Roles)
CREATE TABLE Roles (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) NOT NULL
);

-- Table des utilisateurs (Utilisateurs)
CREATE TABLE Utilisateurs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_role INT(11),
    CONSTRAINT fk_utilisateurs_role FOREIGN KEY (id_role) REFERENCES Roles(id) ON DELETE SET NULL
);

-- Table des services (Services)
CREATE TABLE Services (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    img VARCHAR(255) DEFAULT NULL,
    id_user INT(11),
    CONSTRAINT fk_services_user FOREIGN KEY (id_user) REFERENCES Utilisateurs(id) ON DELETE SET NULL
);

-- Table des rapports vétérinaires (Veterinary_report)
CREATE TABLE Veterinary_report (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    date_report DATE DEFAULT CURDATE(),
    details TEXT,
    health_state VARCHAR(255),
    food VARCHAR(255),
    daily_food TEXT DEFAULT NULL,
    daily_food_date DATE DEFAULT NULL,
    daily_food_time TIME DEFAULT NULL,
    animal_id INT,
    CONSTRAINT fk_veterinary_animal FOREIGN KEY (animal_id) REFERENCES Animals(id) ON DELETE CASCADE
);

-- Insertion des rôles
INSERT INTO Roles (role) VALUES
('administrateur'),
('veterinaire'),
('employe');

-- Insertion espèces
INSERT INTO Species (species) VALUES
('Tigre du Bengale'),
('Éléphant d\'Afrique'),
('Girafe du Niger'),
('Flamant rose'),
('Jaguar'),
('Gorille de l\'Est'),
('Crocodile du Nil'),
('Rhinocéros blanc'),
('Tortue des marais'),
('Lion d\'Afrique'),
('Hyène tachetée'),
('Hippopotame commun'),
('Python réticulé');