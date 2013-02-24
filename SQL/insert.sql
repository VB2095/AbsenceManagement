-------------------------------------------------------------------------------------------------------
									-- INSERT DEPARTEMENT --
-------------------------------------------------------------------------------------------------------
insert into Departement values('GEI');
insert into Departement values('GM');
insert into Departement values('GMM');
insert into Departement values('GC');
insert into Departement values('GPE');
insert into Departement values('GBA');
-------------------------------------------------------------------------------------------------------
									-- INSERT MATIERE --
-------------------------------------------------------------------------------------------------------
insert into Matiere values('MDSI',0);
insert into Matiere values('PF',0);
insert into Matiere values('DSI',1);
insert into Matiere values('Algo distrib',0);
-------------------------------------------------------------------------------------------------------
									-- INSERT SPECIALITE --
-------------------------------------------------------------------------------------------------------
insert into Specialite (nom) values('Info');
	update Specialite
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE nom = 'Info';

insert into Specialite (nom) values('RT');
	update Specialite
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE nom='RT';

insert into Specialite (nom) values('Clim');
	update Specialite
	set departement =(select REF(d) from Departement d where d.libelle='GC')
	WHERE nom='Clim';

insert into Specialite (nom) values('Mmn');
	update Specialite
	set departement =(select REF(d) from Departement d where d.libelle='GMM')
	WHERE nom='Mmn';
-------------------------------------------------------------------------------------------------------
									-- INSERT SECRETAIRE --
-------------------------------------------------------------------------------------------------------	
insert into Secretaire (ident, nom , prenom, date_embauche, statut) values(789999,'nom','prenom','10-02-2010','contractuel');
	update Secretaire
	set departement =(select REF(d) from Departement d where d.libelle='GMM')
	WHERE ident=789999;
	
insert into Secretaire (ident, nom , prenom, date_embauche, statut) values(555666,'Martin','Francois','10-03-2009','permament');
	update Secretaire
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=555666;
	
insert into Secretaire (ident, nom , prenom, date_embauche, statut) values(546316,'Dupont','Martine','07-05-2005','contractuel');
	update Secretaire
	set departement =(select REF(d) from Departement d where d.libelle='GC')
	WHERE ident=546316;
	
insert into Secretaire (ident, nom , prenom, date_embauche, statut) values(613640,'Laval','Josephine','09-12-2000','permanent');
	update Secretaire
	set departement =(select REF(d) from Departement d where d.libelle='STPI')
	WHERE ident=613640;
-------------------------------------------------------------------------------------------------------
									-- INSERT SALLE --
-------------------------------------------------------------------------------------------------------
insert into Salle (ident,nom_salle,type_salle) values(111,'Amphi 111','cours');
	update Salle
	set departement =(select REF(d) from Departement d where d.libelle='STPI')
	WHERE ident=111;

insert into Salle (ident,nom_salle,type_salle) values(8541,'GEI 119','TP');
	update Salle
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=8541;

insert into Salle (ident,nom_salle,type_salle) values(9641,'GM 214','cours');
	update Salle
	set departement =(select REF(d) from Departement d where d.libelle='GM')
	WHERE ident=9641;

insert into Salle (ident,nom_salle,type_salle) values(321,'GEI 103','TP');
	update Salle
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=321;
-------------------------------------------------------------------------------------------------------
									-- INSERT ETUDIANT --
-------------------------------------------------------------------------------------------------------
insert into Etudiant (ident, nom, prenom, num_etud, date_naissance, nationalite, dossier_medical) values(6541,'gareau','adrien','0249826585','19-08-1991','francais',0);
	update Etudiant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=6541;
	
insert into Etudiant (ident, nom, prenom, num_etud, date_naissance, nationalite, dossier_medical) values(9513,'carayol','thomas','04568425894','29-07-1991','francais',0);
	update Etudiant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=9513;
	
insert into Etudiant (ident, nom, prenom, num_etud, date_naissance, nationalite, dossier_medical) values(5313,'dounia','omar','021645652458','20-05-1990','marocain',0);
	update Etudiant
	set departement =(select REF(d) from Departement d where d.libelle='GMM')
	WHERE ident=5313;
	
insert into Etudiant (ident, nom, prenom, num_etud, date_naissance, nationalite, dossier_medical) values(5641,'audibert','ludo','04156589496','03-03-1990','francais',1);
	update Etudiant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=5641;
-------------------------------------------------------------------------------------------------------
									-- INSERT VACATAIRE --
-------------------------------------------------------------------------------------------------------
insert into Vacataire (ident, nom, prenom, num_immat, fonction, statut) values(8974,'vac','prof','41025','prof','vacataire');
	update Vacataire
	set departement =(select REF(d) from Departement d where d.libelle='GPE')
	WHERE ident=8974;
	
insert into Vacataire (ident, nom, prenom, num_immat, fonction, statut) values(4165,'dup','ont','23522','statut','vacataire');
	update Vacataire
	set departement =(select REF(d) from Departement d where d.libelle='GM')
	WHERE ident=4165;
	
insert into Vacataire (ident, nom, prenom, num_immat, fonction, statut) values(0891,'lol','ili','56401','ut','vacataire');
	update Vacataire
	set departement =(select REF(d) from Departement d where d.libelle='GBA')
	WHERE ident=0891;
	
insert into Vacataire (ident, nom, prenom, num_immat, fonction, statut) values(8971,'test','est','6545','esseur','vacataire');
	update Vacataire
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=8971;
-------------------------------------------------------------------------------------------------------
									-- INSERT PERMANENT_ENSEIGNANT --
-------------------------------------------------------------------------------------------------------
insert into Permanent_Enseignant (ident, nom, prenom, num_immat, fonction, statut, est_directeur, est_adjoint) values(36665,'castan','michel','44444','docteur','permanent',1,0);
	update Permanent_Enseignant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=36665;
	
insert into Permanent_Enseignant (ident, nom, prenom, num_immat, fonction, statut, est_directeur, est_adjoint) values(11223,'rocacher','thierry','3212','docteur','permanent',0,0);
	update Permanent_Enseignant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=11223;
	
insert into Permanent_Enseignant (ident, nom, prenom, num_immat, fonction, statut, est_directeur, est_adjoint) values(88877,'monteil','thierry','14741','docteur','permanent',0,1);
	update Permanent_Enseignant
	set departement =(select REF(d) from Departement d where d.libelle='GEI')
	WHERE ident=88877;
-------------------------------------------------------------------------------------------------------
									-- INSERT ATER --
-------------------------------------------------------------------------------------------------------
insert into Ater (ident ,nom , prenom ,num_immat ,fonction, statut) values (55889,'atertest','jesuisAter','5451','rien','ater');
	update Ater
	set departement =(select REF(d) from Departement d where d.libelle='GMM')
	WHERE ident=55889;

insert into Ater (ident ,nom , prenom ,num_immat ,fonction, statut) values (88231,'testater','etAter','1289','dutout','ater');
	update Ater
	set departement =(select REF(d) from Departement d where d.libelle='GC')
	WHERE ident=88231;

insert into Ater (ident ,nom , prenom ,num_immat ,fonction, statut) values(44778,'aterdu','jesuisAter','5451','rien','ater');
	update Ater
	set departement =(select REF(d) from Departement d where d.libelle='GMM')
	WHERE ident=44778;

insert into Ater (ident ,nom , prenom ,num_immat ,fonction, statut) values(55884,'ateeer','IAter','4477','lol','ater');
	update Ater
	set departement =(select REF(d) from Departement d where d.libelle='GPE')
	WHERE ident=55884;
-------------------------------------------------------------------------------------------------------
									-- INSERT SEANCE --
-------------------------------------------------------------------------------------------------------
insert into Seance (ident,type_seance,date_seance) values(5665,'cours','10-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=88877),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'MDSI'),
	salle = (select REF(s) from Salle s where s.ident =111)
	WHERE ident=5665;

insert into Seance (ident,type_seance,date_seance) values(7854,'TP','10-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=11223),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'PF'),
	salle = (select REF(s) from Salle s where s.ident =8541)
	WHERE ident=7854;

insert into Seance (ident,type_seance,date_seance) values(4411,'cours','10-12-2012');
	update Seance
	set enseignant =(select REF(e) from Ater e where e.ident=55889),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'Algo distrib'),
	salle = (select REF(s) from Salle s where s.ident =9641)
	WHERE ident=4411;

insert into Seance (ident,type_seance,date_seance) values(6633,'cours','10-12-2012');
	update Seance
	set enseignant =(select REF(e) from Ater e where e.ident=88231),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'MDSI'),
	salle = (select REF(s) from Salle s where s.ident =9641)
	WHERE ident=6633;
	
insert into Seance (ident,type_seance,date_seance) values(6639,'cours','10-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=88877),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'Algo distrib'),
	salle = (select REF(s) from Salle s where s.ident =9641)
	WHERE ident=6639;

insert into Seance (ident,type_seance,date_seance) values(6634,'cours','11-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=88877),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'MDSI'),
	salle = (select REF(s) from Salle s where s.ident =321)
	WHERE ident=6634;

insert into Seance (ident,type_seance,date_seance) values(6635,'cours','12-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=88877),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'MDSI'),
	salle = (select REF(s) from Salle s where s.ident =321)
	WHERE ident=6635;

insert into Seance (ident,type_seance,date_seance) values(6636,'cours','13-12-2012');
	update Seance
	set enseignant =(select REF(e) from Permanent_Enseignant e where e.ident=88877),
	matiere =(select REF(m) from Matiere m where m.nom_matiere = 'MDSI'),
	salle = (select REF(s) from Salle s where s.ident =321)
	WHERE ident=6636;
-------------------------------------------------------------------------------------------------------
									-- INSERT INSCRIRE --
-------------------------------------------------------------------------------------------------------
insert into Inscrire (id_inscrire) values(3300);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='DSI'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=6541)
	WHERE id_inscrire =3300;

insert into Inscrire (id_inscrire)  values(4400);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='PF'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=9513)
	WHERE id_inscrire =4400;

insert into Inscrire (id_inscrire) values(5500);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='Algo distrib'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=5313)
	WHERE id_inscrire =5500;

insert into Inscrire (id_inscrire) values(6600);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='MDSI'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=5641)
	WHERE id_inscrire =6600;
		
insert into Inscrire (id_inscrire) values(6601);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='MDSI'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=6541)
	WHERE id_inscrire =6601;

insert into Inscrire (id_inscrire) values(6602);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='MDSI'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=9513)
	WHERE id_inscrire =6602;

insert into Inscrire (id_inscrire) values(6603);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='MDSI'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=5313)
	WHERE id_inscrire =6603;

insert into Inscrire (id_inscrire) values(6605);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='Algo distrib'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=64415)
	WHERE id_inscrire =6605;

insert into Inscrire (id_inscrire) values(6604);
	update Inscrire
	set matiere =(select REF(m) from Matiere m where m.nom_matiere='Algo distrib'),
	num_etudiant =(select REF(e) from Etudiant e where e.ident=9513)
	WHERE id_inscrire =6604;
-------------------------------------------------------------------------------------------------------
									-- INSERT ABSENCE --
-------------------------------------------------------------------------------------------------------
insert into Absence (id_absence,est_justifie) values(15000,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 5665),
	etudiant =(select REF(e) from Etudiant e where e.ident = 64415)
	WHERE id_absence = 15000;

insert into Absence (id_absence,est_justifie) values(15001,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6634),
	etudiant =(select REF(e) from Etudiant e where e.ident = 64415)
	WHERE id_absence = 15001;

insert into Absence (id_absence,est_justifie) values(15002,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6635),
	etudiant =(select REF(e) from Etudiant e where e.ident = 64415)
	WHERE id_absence = 15002;

insert into Absence (id_absence,est_justifie) values(15003,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6636),
	etudiant =(select REF(e) from Etudiant e where e.ident = 64415)
	WHERE id_absence = 15003;

insert into Absence (id_absence,est_justifie) values(15004,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6636),
	etudiant =(select REF(e) from Etudiant e where e.ident = 5313)
	WHERE id_absence = 15004;

insert into Absence (id_absence,est_justifie) values(15005,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6635),
	etudiant =(select REF(e) from Etudiant e where e.ident = 5313)
	WHERE id_absence = 15005;

insert into Absence (id_absence,est_justifie,justification) values(15006,1,'certificat medical');
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6634),
	etudiant =(select REF(e) from Etudiant e where e.ident = 5313)
	WHERE id_absence = 15006;

insert into Absence (id_absence,est_justifie,justification) values(15007,1,'sortie de Raiderz');
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6634),
	etudiant =(select REF(e) from Etudiant e where e.ident = 6541)
	WHERE id_absence = 15007;

insert into Absence (id_absence,est_justifie) values(15008,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6639),
	etudiant =(select REF(e) from Etudiant e where e.ident = 5313)
	WHERE id_absence = 15008;

insert into Absence (id_absence,est_justifie) values(15009,0);
	update Absence 
	set seance = (select REF(s) from Seance s where s.ident= 6639),
	etudiant =(select REF(e) from Etudiant e where e.ident = 64415)
	WHERE id_absence = 15009;
	
insert into Absence (id_absence,est_justifie) values(15010,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5666),
    etudiant =(select REF(e) from Etudiant e where e.ident = 6541)
    WHERE id_absence = 15010;

insert into Absence (id_absence,est_justifie) values(15011,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5667),
    etudiant =(select REF(e) from Etudiant e where e.ident = 6541)
    WHERE id_absence = 15011;

insert into Absence (id_absence,est_justifie) values(15012,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5668),
    etudiant =(select REF(e) from Etudiant e where e.ident = 6541)
    WHERE id_absence = 15012;

insert into Absence (id_absence,est_justifie) values(15013,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5669),
    etudiant =(select REF(e) from Etudiant e where e.ident = 6541)
    WHERE id_absence = 15013;

insert into Absence (id_absence,est_justifie) values(15014,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5670),
    etudiant =(select REF(e) from Etudiant e where e.ident = 5641)
    WHERE id_absence = 15014;

insert into Absence (id_absence,est_justifie) values(15015,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5671),
    etudiant =(select REF(e) from Etudiant e where e.ident = 5641)
    WHERE id_absence = 15015;

insert into Absence (id_absence,est_justifie) values(15016,0);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5672),
    etudiant =(select REF(e) from Etudiant e where e.ident = 5641)
    WHERE id_absence = 15016;

insert into Absence (id_absence,est_justifie,justification,credibilite) values(15017,1,'Malade',3);
    update Absence
    set seance = (select REF(s) from Seance s where s.ident= 5673),
    etudiant =(select REF(e) from Etudiant e where e.ident = 5641)
    WHERE id_absence = 15017;

