-- ----------------------------------------------------------------
-- SCRIPT DE CREATION DE LA BASE DE DONNÉES DU PROJET 'JAM PROJECT' 
-- ----------------------------------------------------------------

-- ----------[ creation de la base de données ]----------
DROP DATABASE IF EXISTS jamproject;
CREATE DATABASE IF NOT EXISTS jamproject;
USE jamproject;

-- ----------[ creation des tables ]----------
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	usr_id BIGINT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
    usr_mail VARCHAR(255) UNIQUE NOT NULL,
    usr_pass VARCHAR(255) NOT NULL,
    usr_fname VARCHAR(30),
    usr_lname VARCHAR(30),
    usr_address VARCHAR(50),
    usr_zipcode VARCHAR(10),
    usr_city VARCHAR(50),
    usr_img MEDIUMBLOB
) ENGINE=INNODB;

DROP TABLE IF EXISTS activities;
CREATE TABLE activities (
    act_id BIGINT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
    act_name VARCHAR(30) UNIQUE NOT NULL,
    act_description VARCHAR(255) UNIQUE NOT NULL,
    act_img MEDIUMBLOB,
    act_price DECIMAL(4,2) NOT NULL,
    act_content MEDIUMBLOB
) ENGINE=INNODB;
