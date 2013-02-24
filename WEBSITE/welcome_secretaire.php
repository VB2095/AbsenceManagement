<?php

	echo "<hr><h4>Consultation des absences d'un étudiant</h4>" ;
	
	//OBTENIR LES INFORMATIONS SUR UN ETUDIANT
	echo "<form class='navbar-form pull-left' action='welcome.php' method=post>"; 
	if(isset($_POST['nom_etudiant'])) {
		echo "<input type='text' name='nom_etudiant' class='span2' placeholder='Entrez un nom' value='".$_POST['nom_etudiant']."'/>" ;
	} else {
		echo "<input type='text' name='nom_etudiant' class='span2' placeholder='Entrez un nom'/>" ;
	}
	echo "<input name='valider' class='btn' value='Consulter' type='submit'/>";
	echo "</form><br/><br/><br/>";
	
	if(isset($_POST['valider'])) {
		
		$requete = "SELECT a.seance.matiere.nom_matiere, a.seance.type_seance , a.est_justifie , a.justification , a.credibilite FROM absence a
					WHERE a.etudiant.nom = '".$_POST['nom_etudiant']."'
					ORDER BY a.seance.matiere.nom_matiere" ;
					
		$s = oci_parse($c, $requete);
		$r = oci_execute($s);

		if(!$r) {
			echo "Problème d'execution de la requete de recuperation des absences";
		} else {
			echo "<table  class='table-bordered'>";
			echo "<tr id='entete'>
					<th>Nom de la matiére</th>
					<th>Type de la séance</th>
					<th>Justifié ?</th>
					<th>Jutification</th>
					<th>Crédibilité</th>
				  </tr>";
			while ($row = oci_fetch_array($s)) {
				if($row[2] == 0) {
					echo "<tr id='non_justifie'>";	
					echo "<td>" . $row[0] . "</td>";
					echo "<td>" . $row[1] . "</td>";	
					echo "<td>Non</td>";
					echo "<td>" . $row[3] . "</td>";
					echo "<td>" . $row[4] . "</td>";
					echo "</tr>";
				} else {
					echo "<tr id='justifie'>";	
					echo "<td>" . $row[0] . "</td>";
					echo "<td>" . $row[1] . "</td>";	
					echo "<td>Oui</td>";
					echo "<td>" . $row[3] . "</td>";
					echo "<td>" . $row[4] . "</td>";
					echo "</tr>";
				}
			}
			echo "</table><br/>";
		}
	
	}
	//La liste des �tudiants ayant plus de trois absences non justifi�es en TD TP
	echo "<hr><h4>La liste des étudiants ayant plus de trois absences non justifiées en TD/TP</h4>";
	$requete = "SELECT a.etudiant.num_etud , a.etudiant.nom, a.etudiant.prenom FROM absence a
				WHERE (a.seance.type_seance = 'TD' OR a.seance.type_seance = 'TP')
					AND a.est_justifie = 0
				GROUP BY a.etudiant.num_etud , a.etudiant.nom, a.etudiant.prenom
				HAVING count(*) > 3
				ORDER BY a.etudiant.nom ";
				
	$s = oci_parse($c, $requete);
	$r = oci_execute($s);

	if(!$r) {
		echo "Problème d'execution de la requete de recuperation des absences";
	} else {
		echo "<table  class='table-bordered'>";
		echo "<tr id='entete'>
				<th>Numéro de l'étudiant</th>
				<th>Nom de l'étudiant</th>
				<th>Prénom de l'étudiant</th>
			  </tr>";
		while ($row = oci_fetch_array($s)) {
			echo "<tr id='non_justifie'>";	
			echo "<td>" . $row[0] . "</td>";
			echo "<td>" . ucfirst($row[1]) . "</td>";	
			echo "<td>" . ucfirst($row[2]) . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	//La liste des �tudiants qui ne se sont jamais absent� pour toutes les mati�res
	echo "<hr><h4>La liste des étudiants qui ne se sont jamais absentés pour toutes les matières</h4>";
	$requete = "SELECT e.num_etud , e.nom , e.prenom FROM etudiant e
				WHERE e.ident NOT IN (
					SELECT a.etudiant.ident FROM absence a )" ;
	$s = oci_parse($c, $requete);
	$r = oci_execute($s);

	if(!$r) {
		echo "Problème d'execution de la requete de recuperation des absences";
	} else {
		echo "<table class='table-bordered'>";
		echo "<tr id='entete'>
				<th>Numéro de l'étudiant</th>
				<th>Nom de l'étudiant</th>
				<th>Prénom de l'étudiant</th>
			  </tr>";
		while ($row = oci_fetch_array($s)) {
			echo "<tr id='justifie'>";	
			echo "<td>" . $row[0] . "</td>";
			echo "<td>" . ucfirst($row[1]) . "</td>";	
			echo "<td>" . ucfirst($row[2]) . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	
?>