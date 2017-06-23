--Insert domaines
insert into Domaine values
    ('Aide Menagere'),('Animalerie'),('Audiovisuel'),('Automobile'),
    ('Autre'),('Baby-sitting'),('Bateau'),('Bricolage'),
    ('Cours'),('Electricite'),('Electromenager'),('Exterieur'),
    ('Festivites'),('Gastronomie'),('Immobilier'),('Informatique'),
    ('Jardinage'),('Jeux videos'),('Maconnerie'),('Maison'),
    ('Mecanique'),('Mobilite'),('Moto'),('Musique'),
    ('Peinture'),('Plomberie'),('Sport'),('Soins et beaute'),
    ('Telephonie'),('Vacances');

--Créer un compte (utilisateur)
INSERT INTO Utilisateur values
('bonam','bonam','bonam@bonam.fr','bonam1','BonamVille',59,0.5,50),
('komalis','komalis','komalis@bonam.fr','komalis1','BonamVille',59,5,80),
('twisti','twisti','twisti@bonam.fr','twisti1','twistiVille',93,5,180),
('hqrd','hqrd','hqrd@bonam.fr','hqrd1','BonamVille',59,5,80),
('konke','konke','konke@bonam.fr','konke1','Ville',59,5,82),
('titi','titi','titi@bonam.fr','titi1','BonamVille',59,5,80);

--Enregistrer un avis et une note sur un utilisateur
INSERT INTO Avis values
(1,'bonam','konke','Ceci est un commentaire super','2015-12-02 08:14:07',5),
(2,'konke','bonam','Ceci est un commentaire super','2015-12-02 09:14:07',5),
(3,'konke','konke','Ceci est un commentaire super','2015-12-02 07:14:07',5),
(4,'konke','komalis','Ceci est un commentaire nul','2015-12-02 06:14:07',1),
(5,'titi','komalis','Ceci est un commentaire nul','2015-12-02 07:14:07',1),
(6,'twisti','hqrd','Ceci est un commentaire très bien','2015-12-02 08:14:07',4);

--Créer une offre
insert into Formulaire values 
    (1,'bonam','TitreFormulaire1',true,'DescriptionFormulaire1Animalerie',59,10,'2015-12-02 03:14:07'),
    (2,'komalis','TitreFormulaire2',true,'DescriptionFormulaire2Cours',59,33,'2015-12-02 03:14:07');
    insert into ListeFormulaireDomaine values
        (1,'Animalerie'),
        (2,'Cours');
        
--Créer une demande
insert into Formulaire values 
    (3,'twisti','TitreFormulaire3',false,'DescriptionFormulaire3Animalerie',59,13,'2015-12-02 03:14:07'),
    (4,'hqrd','TitreFormulaire4',false,'DescriptionFormulaire4CoursMecanique',59,8,'2015-12-02 03:14:07');
    insert into ListeFormulaireDomaine values
        (3,'Animalerie'),
        (4,'Cours'),
        (4,'Mecanique');
        

--Enregistrer un message entre 2 utilisateurs
INSERT INTO Message values
(1,'bonam','konke','salut',false,'2015-12-02 03:14:07'),
(2,'twisti','hqrd','yo',false,'2015-12-02 03:14:07'),
(3,'komalis','bonam','hi',false,'2015-12-02 03:14:07');
