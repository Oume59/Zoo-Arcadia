CREATE TABLE Roles (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  role VARCHAR(50) NOT NULL
);

INSERT INTO
  Roles (role)
VALUES
  ('administrateur'),
  ('veterinaire'),
  ('employe');

CREATE TABLE Utilisateurs (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  id_role INT(11)
);

ALTER TABLE
  Utilisateurs
ADD
  CONSTRAINT fk_utilisateurs_role FOREIGN KEY (id_role) REFERENCES Roles(id);

CREATE TABLE Habitats (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  img VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  commentaire TEXT DEFAULT NULL
);

CREATE TABLE Species (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  species VARCHAR(50) DEFAULT NULL
);

CREATE TABLE Animals (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  species_id INT(11),
  img VARCHAR(255) DEFAULT NULL,
  habitat_id INT(11)
);

ALTER TABLE
  Animals
ADD
  CONSTRAINT fk_animals_species FOREIGN KEY (species_id) REFERENCES Species(id);

ALTER TABLE
  Animals
ADD
  CONSTRAINT fk_animals_habitat FOREIGN KEY (habitat_id) REFERENCES Habitats(id);

CREATE TABLE Services (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT DEFAULT NULL,
  img VARCHAR(255) DEFAULT NULL,
  id_user INT(11)
);

ALTER TABLE
  Services
ADD
  CONSTRAINT fk_services_user FOREIGN KEY (id_user) REFERENCES Utilisateurs(id);

CREATE TABLE Veterinary_report (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  date_report DATE NOT NULL DEFAULT CURRENT_DATE,
  details TEXT DEFAULT NULL,
  health_state VARCHAR(255) DEFAULT NULL,
  food VARCHAR(255) DEFAULT NULL,
  animal_id INT(11) NOT NULL,
  daily_food TEXT DEFAULT NULL,
  daily_food_date DATE DEFAULT NULL,
  daily_food_time TIME DEFAULT NULL
);

ALTER TABLE
  Veterinary_report
ADD
  CONSTRAINT fk_animal FOREIGN KEY (animal_id) REFERENCES Animals(id) ON DELETE CASCADE;