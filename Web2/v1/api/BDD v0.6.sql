DROP TABLE IF EXISTS Formulaire CASCADE;
DROP TABLE IF EXISTS Domaine CASCADE;
DROP TABLE IF EXISTS ListeFormulaireDomaine CASCADE;
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

INSERT INTO Utilisateur
VALUES
('onche', 'onche', 'onche@onche.fr', 'onche', 'onche', 59, 3, 50);

INSERT INTO Avis
VALUES
(1, 'onche', 'onche', 'onche', '23/12/1996', 3),
(3, 'onche', 'onche', 'onche', '23/12/1996', 3),
(5, 'onche', 'onche', 'onche', '23/12/1996', 3);