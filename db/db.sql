CREATE DATABASE pet_shop;
USE pet_shop;

CREATE TABLE clientes (
   id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
   nome VARCHAR(50) NOT NULL,
   email VARCHAR(100) NOT NULL,
   telefone VARCHAR(20) NOT NULL
);

CREATE TABLE animais (
   id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
   nome VARCHAR(50) NOT NULL,
   especie VARCHAR(50) NOT NULL
   raca VARCHAR(50) NOT NULL,
   idade INT NOT NULL, 
   cliente_id INT
   FOREIGN KEY (cliente_id) REFERENCES clientes(id)
   
);