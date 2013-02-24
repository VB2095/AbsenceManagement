<?php

	//Fonction pour un étudiant
	echo "<hr><h4>Voici un récapitulatif de vos absences : </h4>" ;
	
	$requete = "SELECT a.seance.matiere.nom_matiere, a.seance.type_seance , a.est_justifie , a.justification , a.credibilite 
			   FROM absence a WHERE a.etudiant.ident = ".$_SESSION['IDENT']."
			   ORDER BY a.seance.matiere.nom_matiere" ;

	$s = oci_parse($c, $requete);
	$r = oci_execute($s);

	if(!$r) {
		echo "Problème d'execution de la requete de recuperation des absences";
	} else {
		echo "<table  class='table-bordered'>";
		echo "<tr id='entete' class='info'>
				<th>Nom de la matière</th>
				<th>Type de la séance</th>
				<th>Justifié ?</th>
				<th>Jutification</th>
				<th>Crédibilité</th>
			  </tr>";
		while ($row = oci_fetch_array($s)) {
			if($row[2] == 0) {
				echo "<tr id='non_justifie'>";	
				echo "<td>" . $row[0] . "</td>";
				echo "<td>" . ucfirst($row[1]) . "</td>";	
				echo "<td>Non</td>";
				echo "<td>" . ucfirst($row[3]) . "</td>";
				echo "<td>" . $row[4] . "</td>";
				echo "</tr>";
			} else {
				echo "<tr id='justifie'>";	
				echo "<td>" . $row[0] . "</td>";
				echo "<td>" . ucfirst($row[1]) . "</td>";	
				echo "<td>Oui</td>";
				echo "<td>" . ucfirst($row[3]) . "</td>";
				echo "<td>" . $row[4] . "</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}
	
?>
