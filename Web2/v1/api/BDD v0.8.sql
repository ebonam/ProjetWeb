DROP TABLE IF EXISTS Formulaire CASCADE;
DROP TABLE IF EXISTS Domaine CASCADE;
DROP TABLE IF EXISTS ListeFormulaireDomaine CASCADE;
DROP TABLE IF EXISTS FormulaireSouscrit CASCADE;
DROP TABLE IF EXISTS Utilisateur CASCADE;
DROP TABLE IF EXISTS Avis CASCADE;
DROP TABLE IF EXISTS Message CASCADE;

CREATE TABLE Utilisateur (
	login text PRIMARY KEY NOT NULL,
	mdp text NOT NULL,
	mail text UNIQUE NOT NULL CHECK (mail ILIKE '%@%.%'),
	nom text NOT NULL,
	ville text NOT NULL,
	departement int NOT NULL CHECK (departement > 0 AND departement < 100),
	notation float DEFAULT 0 CHECK (notation >= 0 AND notation <= 6),
	points int DEFAULT 50
);

CREATE TABLE Avis (
	IDAvis serial primary key,
	Cible text NOT NULL,
	Votant text NOT NULL,
	Description text not null,
	date timestamp,
	note int CHECK (note >= 0 AND note <= 6),
	FOREIGN KEY (cible) REFERENCES Utilisateur(login),
	FOREIGN KEY (votant) REFERENCES Utilisateur(login)
	);

CREATE TABLE Formulaire (
	ID serial primary key,
	createur text REFERENCES Utilisateur(login),
	Titre text not null,
	Type boolean, /* offre = true, demande = false*/
	Description text not null,
	Departement int not null,
	Point int,
	date timestamp,
	check (Departement >0 AND Departement <99)
	);
	
CREATE TABLE Domaine (
	Nom text primary key
	);

CREATE TABLE ListeFormulaireDomaine (
	IDListe serial references Formulaire(ID),
	NomDomaine text references Domaine(Nom),
	primary key(IDListe,NomDomaine) 
	);

CREATE TABLE FormulaireSouscrit (
	Utilisateur text references Utilisateur(login),
	IDForm serial references Formulaire(ID),
	valide boolean DEFAULT true,
	primary key(Utilisateur,IDForm) 
	);	
	
CREATE TABLE Message (
	ID serial primary key,
	Destinataire text not null,
	Receveur text not null,
	Texte text not null,
	lu boolean,
	date timestamp,
	FOREIGN KEY (Destinataire) REFERENCES Utilisateur(login),
	FOREIGN KEY (Receveur) REFERENCES Utilisateur(login)
	);

INSERT INTO Utilisateur values
('bonam','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','bonam@bonam.fr','Antoine Bonamy','Clairfayts',59,5,150),
('komalis','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','komalis@bonam.fr','Benjamin Bonvarlet','Hautmont',59,2,80),
('twisti','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','twisti@bonam.fr','Maubeuge','Thibault Ladent',59,2,180),
('hqrd','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','hqrd@bonam.fr','Julien Pruvost','Dust II',93,6,120),
('konke','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','konke@bonam.fr','Julien Letertre','Hautmont',59,5,82),
('titi','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','titi@bonam.fr','Etienne Dhaussy','Douay',59,3,80),
('matmat','$2y$09$QAYfdyYWLY1UucCPPD3EB.Xd0bn0gwb3UEpNXeaCSUgq4JIagsFDq','matmat@bonam.fr','Mathieu Dhondt','Caudry',59,3,2);

--offre true demande false
insert into Formulaire values 
(1,'twisti','Aide PhotoShop',true,'Cours de montage PhotoShop pour rigoler avec les photos de vos amis ou pour faire des images pro !! ',59,10,'2015-12-02 03:14:07'),
(2,'hqrd','Aide CSS',true,'Cours CS pour devenir Global Elite et devenir professionnel, étant un ancien pro ( reference hqrd sur google ) !',93,25,'2015-12-06 03:14:07'),
(3,'komalis','Apprendre à conduire',false,'Actuellement en auto école, je trouve leur prix abusif, si quelqu un veux bien maider sa serait simpatique #grosmalis',59,0,'2015-12-10 09:30:07'),
(4,'titi','Aide programmation',false,'HELP ME TO LEARN JAVA',59,0,'2015-12-11 15:14:07'),
(5,'matmat','Self Contrôle',false,'Je m enerve regulierement, jai besoin de cours de yago svp !!',59,0,'2015-12-11 20:32:07'),
(6,'bonam','Cahier d appel',true,'Pour tous ceux qui oublie la cahier dappel je suis la !',59,5,'2015-12-06 22:14:07'),
(7,'konke','travail au drive',true,'>Directeur d auchan drive, je recherche un srab pour m aider dans mon travail, vous serez payé en points',59,66,'2015-12-11 23:45:07');

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

insert into ListeFormulaireDomaine values
(1,'Audiovisuel'),
(2,'Jeux videos'),
(3,'Automobile'),
(4,'Informatique'),
(5,'Soins et beaute'),
(6,'Cours'),
(7,'Autre');
	
--Enregistrer un avis et une note sur un utilisateur
INSERT INTO Avis values
(1,'bonam','konke','Meilleur coach du monde','2015-12-02 08:14:07',5),
(2,'konke','bonam','Je te sens bien impliqué, mais des conflit avec le cahier :/','2015-12-02 09:14:07',4),
(3,'komalis','matmat','Je suis desole il ny a pas de foreach !','2015-12-02 07:14:07',1),
(4,'titi','komalis','Braw','2015-12-02 06:14:07',1),
(5,'matmat','twisti','Best photoshop EVER ! ici triangle','2015-12-02 07:14:07',4),
(6,'twisti','hqrd','Bon carry CS','2015-12-02 08:14:07',4),
(7,'hqrd','titi','Cava mais prenom non utilise depuis 1975 Six....','2015-12-02 08:14:07',3);

--Enregistrer un message entre 2 utilisateurs
INSERT INTO Message values
(1,'bonam','konke','braw',false,'2015-12-02 03:14:07'),
(2,'twisti','hqrd','yo',false,'2015-12-02 03:14:07'),
(3,'komalis','bonam','hi',false,'2015-12-02 03:14:07'),
(4,'konke','bonam','arretez monsieur',false,'2015-12-02 03:14:07');