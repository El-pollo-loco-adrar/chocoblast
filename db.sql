-- Création de la Base de données
CREATE DATABASE chocoblast CHARSET utf8mb4;
USE chocoblast;

-- Création des tables
CREATE TABLE users(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
pseudo VARCHAR(50) UNIQUE,
email VARCHAR(50) UNIQUE NOT NULL,
`password` VARCHAR(100) NOT NULL,
img_profile VARCHAR(255) DEFAULT "profil.png",
`grants` VARCHAR(255),
`status` BOOL DEFAULT true
)ENGINE=InnoDB;

CREATE TABLE chocoblast(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
slogan VARCHAR(50) NOT NULL,
content VARCHAR(255) NOT NULL,
img_blast VARCHAR(255),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
updated_at DATETIME,
`status` BOOL DEFAULT true,
apply BOOL,
id_target INT NOT NULL,
id_blaster INT NOT NULL 
)ENGINE=InnoDB;

CREATE TABLE note(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
note INT NOT NULL,
id_chocoblast INT NOT NULL,
id_user INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE commentary(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
content VARCHAR(255) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
updated_at DATETIME,
`status` BOOL DEFAULT true,
id_chocoblast INT NOT NULL,
id_author INT NOT NULL
)ENGINE=InnoDB;

-- Ajout des contraintes
ALTER TABLE note
ADD CONSTRAINT fk_to_like_user
FOREIGN KEY(id_user)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE note
ADD CONSTRAINT fk_to_assign_chocoblast
FOREIGN KEY(id_chocoblast)
REFERENCES chocoblast(id)
ON DELETE CASCADE;

ALTER TABLE chocoblast
ADD CONSTRAINT fk_to_blast_user
FOREIGN KEY(id_blaster)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE chocoblast
ADD CONSTRAINT fk_to_target_user
FOREIGN KEY(id_target)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE commentary
ADD CONSTRAINT fk_to_write_user
FOREIGN KEY(id_author)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE commentary
ADD CONSTRAINT fk_to_add_chocoblast
FOREIGN KEY(id_chocoblast)
REFERENCES chocoblast(id)
ON DELETE CASCADE;