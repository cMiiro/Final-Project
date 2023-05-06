CREATE DATABASE tsg_base CHARACTER SET 'utf8';

USE tsg_base;

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

--Maintenant on va pour les examples mettres des utilisateur et des commentaire

-- On va créer Serge un compte Modérateur(Son mot de passe est "moderateur")

INSERT INTO user VALUES('Serge' , 'Serge' ,'Serge' ,'$2y$10$MtrbMOMHII.o6GdrU7byPenMEen6.Q1uPjLsBnENpRZtV4k1R5WRy',NULL ,'profil/Serge.jpg',0 ,0, 1,0);
CREATE TABLE sergeAbonnement(user VARCHAR(30));
CREATE TABLE sergeLike(NumeroId INT);

-- On va créer mainetant des utilisateur normaux (Leur mot de passe est "utilisateur" mais on ne vas pas les utiliser)

INSERT INTO user VALUES('Pery' , 'Camille' ,'Cam' ,'$2y$10$h3/i5daAyLVTtBiKlN6HQ.rSmC5QLlSvA/YP/iy48oYC/mIDqxLgG',NULL ,'profil/Cam.png',0 ,0, 0,0);
CREATE TABLE camAbonnement(user VARCHAR(30));
CREATE TABLE camLike(NumeroId INT);
INSERT INTO user VALUES('Bayard' , 'Nicolas' ,'Zhaoya' ,'$2y$10$h3/i5daAyLVTtBiKlN6HQ.rSmC5QLlSvA/YP/iy48oYC/mIDqxLgG',NULL ,'profil/Zhaoya.png',0 ,0, 0,1);
CREATE TABLE zhaoyaAbonnement(user VARCHAR(30));
CREATE TABLE zhaoyaLike(NumeroId INT);
INSERT INTO user VALUES('' , '' ,'util3' ,'$2y$10$h3/i5daAyLVTtBiKlN6HQ.rSmC5QLlSvA/YP/iy48oYC/mIDqxLgG',NULL ,'image/profilvide.png',0 ,0, 0,0);
CREATE TABLE util3Abonnement(user VARCHAR(30));
CREATE TABLE util3Like(NumeroId INT);
INSERT INTO user VALUES('' , '' ,'util4' ,'$2y$10$h3/i5daAyLVTtBiKlN6HQ.rSmC5QLlSvA/YP/iy48oYC/mIDqxLgG',NULL ,'image/profilvide.png',0 ,0, 0,0);
CREATE TABLE util4Abonnement(user VARCHAR(30));
CREATE TABLE util4Like(NumeroId INT);

-- On créer maintenant des publications

INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('Cam' , 'publication/publi1.jpeg' ,'J\'en fais encore des cauchemars' ,'2023-05-06 09:02:50',0,0);
INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('Cam' , 'publication/publi2.jpg' ,'Meilleur jeu' ,'2023-05-06 09:02:50',0,0);
INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('util3' , 'publication/publi3.png' ,'Enfin finis Mario 64 : )' ,'2023-05-06 09:02:50',0,0);
INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('util3' , 'publication/publi4' ,'$description' ,'2023-05-06 09:02:50',0,0);
INSERT INTO publications ( NomUtil , lienImage , DescriptionImage , dateActu, aime ,prive ) VALUES('util4' , 'publication/publi5' ,'$description' ,'2023-05-06 09:02:50',0,1);


--On créer maintenant des commentaires

INSERT INTO commentaire (NomUtil, TexteCom, idPublication) VALUES('zhaoya','GG',3);
INSERT INTO commentaire (NomUtil, TexteCom, idPublication) VALUES('cam','first',3);
INSERT INTO commentaire (NomUtil, TexteCom, idPublication) VALUES('util4','Gors naze',1);
INSERT INTO commentaire (NomUtil, TexteCom, idPublication) VALUES('zhaoya','Trop vrai',2);