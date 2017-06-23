<?php
$dbconn=connection de la base de donn�e
$array= tableau des parametres 

$result = pg_prepare($dbconn, "my_query", 'INSERT into Utilisateur (login,mdp,mail,nom,ville,departement)
values($1,$2,$3,$4,$6)');

$result = pg_execute($dbconn, "my_query", $array);

--Cr�er un compte (utilisateur)

$result = pg_prepare($dbconn, "my_query", 'INSERT into Utilisateur (login,mdp,mail,nom,ville,departement)
values($1,$2,$3,$4,$6)');
$result = pg_execute($dbconn, "my_query", $array);


INSERT into Utilisateur (login,mdp,mail,nom,ville,departement) values()

--Cr�er une offre
$result = pg_prepare($dbconn, "my_query", 'INSERT into Utilisateur (login,type,Description,Departement,point)
values($1,true,$2,$3,$4)');
$result = pg_execute($dbconn, "my_query", $array);




--Cr�er une demande
$result = pg_prepare($dbconn, "my_query", 'INSERT into Utilisateur (login,type,Description,Departement,point)'
values($1,false,$2,$3,$4));


--Enregistrer un avis et une note sur un utilisateur
$result = pg_prepare($dbconn, "my_query", 'INSERT into  (login,type,Description,Departement,point)
values($1,false,$3,$4,$5)');

--Enregistrer un message entre 2 utilisateurs

$result = pg_prepare($dbconn, "my_query", 'INSERT into  (login,type,Description,Departement,point)
values($1,false,$3,$4,$5)');

--Rechercher des offres selon un domaine & un d�partement
$result=pg_prepare($dbcon,"SELECT f.ID  FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON 
lfd.IDListe = f.ID WHERE lfd.NomDomaine = $1 AND f.Departement = $2 AND f.Type = true"


--Rechercher des demandes selon un domaine & un d�partement

$result=pg_prepare($dbcon,"SELECT f.ID  FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON 
lfd.IDListe = f.ID WHERE lfd.NomDomaine = $1 AND f.Departement = $2 AND f.Type = true");

-- rechercher selon plusieurs domains 

<<<<<<< Temporary merge branch 1
$str="Select f.ID From formulaire f join ListeFormulaireDomaine lfd on lfd.idListe=f.id where lfd on 
lfd.idListe=f.ID where lfd.NomDomaine =$1  and f.departement =$3 and f.type) true";
while ($i<$nombre_de domain ){


}



--rechercher des demandes selon un domaines & un departemen0t
$result=pg_prepare($dbcon,"SELECT f.ID FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = $1 OR lfd.NomDomaine = $2 and type=true");


$result=pg_prepare($dbcon,"SELECT f.ID FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = $1 OR lfd.NomDomaine = $2 and type =false");
}



$result=pg_prepare($dbcon,"SELECT f.ID FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = $1 OR lfd.NomDomaine = $2 and type=true");


$result=pg_prepare($dbcon,"SELECT f.ID FROM Formulaire f JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE lfd.NomDomaine = $1 OR lfd.NomDomaine = $2 and type =false");




--Liste de toutes les offres

$result=pg_prepare($dbcon,"SELECT * FROM Formulaire WHERE Type = true");

--Liste de toutes les demandes
$result=pg_prepare($dbcon,"SELECT * FROM Formulaire WHERE Type = false");



--Liste de tout les domaines

$result =pg_prepare($dbcon,"SELECT * FROM Domaine"); 

--list de tout les messages envoy�s 
$result = pg_prepare($debcon,"Select *from Message where destinataire=$1");

-list de tout les messages recus 
$result =pg_prepare($debcon,"Select *from Message where receveur=$1 order by date")

?>