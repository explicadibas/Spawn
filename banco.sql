-- USUÁRIO      = id, nome, idade, e-mail, senha

-- EMPRESA      = id, nome, ramo, vagas, numeroFuncionários, dataCriação

-- PORTIFÓLIO   = id

-- FUNCIONÁRIOS = id, nome, área, salário, cargaHorária, dataContratação

-- FINANÇAS     = id

CREATE DATABASE Spawn;
USE Spawn;

CREATE TABLE usuarios
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (60) NOT NULL,
    idade INT NOT NULL,
    email VARCHAR (50) NOT NULL,
    senha VARCHAR (20) NOT NULL,
    imgperfil VARCHAR(40)
);

CREATE TABLE imagens
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    imagem VARCHAR(40) NOT NULL,
    data DATETIME 
);

CREATE TABLE empresas
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome_empresa VARCHAR(60) NOT NULL,
    email_empresa VARCHAR(50),
    formal INT,
    capital NUMERIC(13,2),
    funcionarios INT,

    CONSTRAINT fk_nomeusuario FOREIGN KEY (id)
            REFERENCES usuarios(id)
);