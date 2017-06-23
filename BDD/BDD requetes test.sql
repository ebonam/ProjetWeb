--Rechercher des offres selon un domaine & un département
SELECT f.ID , f.Titre , f.Description , f.date
FROM Formulaire f
JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = 'Animalerie' AND f.Departement = 59 AND f.Type = true

--Rechercher des demandes selon un domaine & un département
SELECT f.ID , f.Titre , f.Description , f.date
FROM Formulaire f
JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = 'Animalerie' AND f.Departement = 59 AND f.Type = false

--Liste des utilisateurs d'un département
SELECT nom , ville , mail
FROM Utilisateur
WHERE departement = 59

--Liste de toutes les offres
SELECT *
FROM Formulaire
WHERE Type = true

--Liste de toutes les demandes
SELECT *
FROM Formulaire
WHERE Type = false

--Liste de tout les domaines
SELECT * FROM Domaine

--Afficher tout les messages d'un utilisateur
SELECT ID , Destinataire , texte , lu , date
FROM Message
WHERE Receveur = 'hqrd'

--Afficher tout les avis sur un utilisateur
SELECT IDAvis , Votant , Description , note , date
FROM Avis
WHERE Cible = 'konke'