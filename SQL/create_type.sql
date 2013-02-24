--------------------------------------------------------
					-- Speciality --
--------------------------------------------------------
CREATE TYPE specialite_type AS OBJECT (
nom varchar(20),
departement ref departement_type);
--------------------------------------------------------
					-- Department --
--------------------------------------------------------
CREATE TYPE departement_type AS OBJECT (
libelle varchar(20),
directeur ref directeur_type,
adjoint ref adjoint_type);
--------------------------------------------------------
					-- Person --
--------------------------------------------------------
CREATE TYPE personne_type AS OBJECT (
id integer ,
nom varchar(20),
prenom varchar(20),
departement ref departement_type) NOT FINAL;
--------------------------------------------------------
					-- Secretary --
--------------------------------------------------------
CREATE TYPE secretaire_type UNDER personne_type (
date_embauche date,
statut varchar(20));
--------------------------------------------------------
					-- Student --
--------------------------------------------------------
CREATE TYPE etudiant_type UNDER personne_type (
num_etud varchar(20),
date_naissance date,
nationalite varchar(20),
dossier_medical boolean);
--------------------------------------------------------
					-- Teacher --
--------------------------------------------------------
CREATE TYPE enseignant_type UNDER personne_type (
num_immat varchar(20),
fonction varchar(30),
statut varchar(20));
--------------------------------------------------------
				-- "Vacataire Teacher" --
--------------------------------------------------------
CREATE TYPE vacataire_type UNDER enseignant_type ();
--------------------------------------------------------
				-- "ATER Teacher" --
--------------------------------------------------------
CREATE TYPE ater_type UNDER enseignant_type ();
--------------------------------------------------------
				-- "Permanent Teacher" --
--------------------------------------------------------
CREATE TYPE permanent_enseignant_type UNDER enseignant_type ();
--------------------------------------------------------
				-- "Co-Director" --
--------------------------------------------------------
CREATE TYPE adjoint_type UNDER permanent_enseignant_type ();
--------------------------------------------------------
				-- "Director" --
--------------------------------------------------------
CREATE TYPE directeur_type UNDER permanent_enseignant_type ();
--------------------------------------------------------
				-- Session --
--------------------------------------------------------
CREATE TYPE seance_type AS OBJECT (
id integer ,
type_seance varchar(20),
date_seance date,
enseignant ref enseignant_type,
matiere ref matiere_type,
salle ref salle_type);
--------------------------------------------------------
				-- Absence --
--------------------------------------------------------
CREATE TYPE absence_type AS OBJECT (
seance ref seance_type ,
etudiant ref etudiant_type,
est_justifie integer,
justification varchar(200),
credibilite integer);
--------------------------------------------------------
				-- Registration --
--------------------------------------------------------
CREATE TYPE inscrire_type AS OBJECT (
matière ref matiere_type ,
num_etudiant ref etudiant_type);
CREATE TYPE salle_type AS OBJECT (
id integer,
nom_salle varchar(20),
type_salle varchar(20),
departement ref departement_type);
--------------------------------------------------------
				-- Subject --
--------------------------------------------------------
CREATE TYPE matiere_type AS OBJECT (
nom_matiere varchar(20),
est_optionnel boolean);