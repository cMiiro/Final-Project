CREATE TABLE user(
    Nom VARCHAR(30),
    Prenom VARCHAR(30),
    NomUtil VARCHAR(15),
    mdp VARCHAR(100),
    Description VARCHAR(160), 
    PhotoProfil VARCHAR(160),
    abonees INT,
    Ban BOOLEAN,
    Modo BOOLEAN,
    prive BOOLEAN);


    CREATE TABLE publications(
    NomUtil varchar(30),
    lienImage varchar(2083),
    DescriptionImage varchar(500),
    dateActu DATETIME,
    aime INT,
    prive BOOLEAN,
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT);

     CREATE TABLE commentaire(
         NomUtil varchar(30),
         TexteCom varchar(60),
         idPublication INT,
         id INT PRIMARY KEY NOT NULL AUTO_INCREMENT);

     CREATE TABLE signalement(
        utilSignal varchar(30),
        idPublication INT);