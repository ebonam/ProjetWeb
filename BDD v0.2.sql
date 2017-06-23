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
	notation float DEFAULT 0 CHECK (notation > 0 AND notation < 6),
	points int DEFAULT 50
);

CREATE TABLE Avis (
	IDAvis int primary key,
	cible text NOT NULL,
	votant text NOT NULL,
	note int CHECK (note > 0 AND note < 6),
	commentaire text not null,
	FOREIGN KEY (cible) REFERENCES Utilisateur(login),
	FOREIGN KEY (votant) REFERENCES Utilisateur(login)
	);

CREATE TABLE Formulaire (

	ID int primary key,
	Titre text not null,
	Type boolean, /* offre = true, demande = false*/
	Description text not null,
	Departement int not null,
	Point int,
	check (Departement >0 AND Departement <99)
	);
	
CREATE TABLE Domaine (
	Nom text primary key
	);

CREATE TABLE ListeFormulaireDomaine (
	IDListe int references Formulaire(ID),
	NomDomaine text references Domaine(Nom),
	primary key(IDListe,NomDomaine) 
	);

CREATE TABLE Message (
	ID int primary key,
	Destinataire text references Utilisateur(login),
	Receveur text references Utilisateur(login),
	Msg text not null

	);