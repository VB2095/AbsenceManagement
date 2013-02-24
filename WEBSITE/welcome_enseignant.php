 <?php
	//Fonction pour un enseignant
	echo "<hr><h4>Recherche d'étudiants</h4>Veuillez selectionner un cours<br/>" ;
	
	$requete = "SELECT s.matiere.nom_matiere FROM seance s
				WHERE s.enseignant.ident = ".$_SESSION['IDENT']."
				GROUP BY s.matiere.nom_matiere" ;

	$s = oci_parse($c, $requete);
	$r = oci_execute($s);

	if(!$r) {
		echo "Problème d'execution de la requete de recuperation de vos cours";
	} else {
		echo "<form class='form-search' action='welcome.php' method=post>"; 
		echo "<select id='listeCours' name='listeCours'>";
		echo "<option id='null' value=''></option>";
		while ($row = oci_fetch_array($s)) {
			if($_POST['listeCours'] == $row[0]) {
				echo "<option selected='selected' id='". $row[0] ."' value='". $row[0] ."'>". $row[0] . "</option>";
			} else {
				echo "<option id='". $row[0] ."' value='". $row[0] ."'>". $row[0] . "</option>";
			}
		}
		echo "</select>";
		echo "<hr><h5>Options avancées de recherche</h5>";
		if(isset($_POST['cours'])) {
			echo "<input type='checkbox' id='cours' name='cours' class='regular-checkbox' checked/><label for='cours'>Cours</label>";
		} else {
			echo "<input type='checkbox' id='cours' name='cours' class='regular-checkbox'/><label for='cours'>Cours</label>";
		}
		if(isset($_POST['TD'])) {
			echo "<input type='checkbox' id='TD' name='TD' class='regular-checkbox' checked/><label for='TD'>TD's</label>";
		} else {
			echo "<input type='checkbox' id='TD' name='TD' class='regular-checkbox'/><label for='TD'>TD's</label>";
		}
		if(isset($_POST['TP'])) {
			echo "<input type='checkbox' id='TP' name='TP' class='regular-checkbox' checked/><label for='TP'>TP's</label>";
		} else {
			echo "<input type='checkbox' id='TP' name='TP' class='regular-checkbox'/><label for='TP'>TP's</label>";
		}	
		if(isset($_POST['justification'])) {
			echo "<input type='checkbox' id='justification' name='justification' class='regular-checkbox' checked/><label for='justification'>Prendre en compte les justifications</label>";
		} else {
			echo "<input type='checkbox' id='justification' name='justification' class='regular-checkbox'/><label for='justification'>Prendre en compte les justifications</label>";
		}	
		
		echo "<hr><input class='btn' name='valider' value='Rechercher' type='submit'/>"; 
		echo "</form>";
	}
	
	
	if(isset($_POST['valider'])) {
		//TABLEAU POUR TOUS CEUX QUI NE SONT JAMAIS ALLER EN COURS
		$titre = "<hr><h4>Etudiants qui ne sont jamais allés aux cours de ".$_POST['listeCours']."</h4>";
		echo $titre ;
		
		$requete = "SELECT a.etudiant.num_etud , a.etudiant.nom , a.etudiant.prenom FROM absence a
					WHERE a.seance.enseignant.ident = ".$_SESSION['IDENT']." 
						AND a.seance.matiere.nom_matiere = '".$_POST['listeCours']."' 
					GROUP BY a.etudiant.num_etud , a.etudiant.nom , a.etudiant.prenom
					HAVING count(*) = (
						SELECT count(*) FROM seance s
						WHERE s.matiere.nom_matiere = '".$_POST['listeCours']."'
							AND s.enseignant.ident = ".$_SESSION['IDENT']." 
						GROUP BY s.matiere.nom_matiere)" ;
							
		$s = oci_parse($c, $requete);
		$r = oci_execute($s);
		
		if(!$r) {
			echo "Problème d'execution de la requete de recuperation des absents";
		} else {
			echo "<table  class='table-bordered'>";
			echo "<tr id='entete'>
					<th>Numéro d'étudiant</th>
					<th>Nom de l'étudiant</th>
					<th>Prénom de l'étudiant</th>
				  </tr>";
			while ($row = oci_fetch_array($s)) {
				echo "<tr id='full'>";	
				echo "<td>" . $row[0] . "</td>";
				echo "<td>" . ucfirst($row[1]) . "</td>";	
				echo "<td>" . ucfirst($row[2]) . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
	
		//TABLEAU POUR LES ABSENCES
		$titre = "<hr><h4>Etudiants absents pour tous les ";
		if(isset($_POST['cours'])) {
			$titre .= "Cours" ;
		}
		if(isset($_POST['TD'])) {
			$titre .= "/TD" ;
		}
		if(isset($_POST['TP'])) {
			$titre .= "/TP" ;
		}
		if(!isset($_POST['cours']) && !isset($_POST['TD']) && !isset($_POST['TP'])) {
			$titre .= "Cours/TD's/TP's";
		}
		$titre .= " dispensés en ".$_POST['listeCours']."</h4>" ;
		echo $titre;
		$requete1 = "SELECT a.etudiant.num_etud , a.etudiant.nom , a.etudiant.prenom , count(*) as nb_absences FROM absence a
				     WHERE a.seance.enseignant.ident = ".$_SESSION['IDENT']." 
					   AND a.seance.matiere.nom_matiere = '".$_POST['listeCours']."' ";
		if(isset($_POST['cours']) && isset($_POST['TD']) && isset($_POST['TP'])) 
		{
		} 
		else 
		{
			if(isset($_POST['cours']) && isset($_POST['TD'])) 
			{
				$requete1 .= "AND (a.seance.type_seance = 'cours' OR a.seance.type_seance = 'TD')";
			} 
			else 
			{
				if(isset($_POST['cours']) && isset($_POST['TP'])) 
				{
					$requete1 .= "AND (a.seance.type_seance = 'cours' OR a.seance.type_seance = 'TP')";
				} 
				else 
				{
					if(isset($_POST['TD']) && isset($_POST['TP'])) 
					{
						$requete1 .= "AND (a.seance.type_seance = 'TD' OR a.seance.type_seance = 'TP')";
					}
					else
					{
						if(isset($_POST['cours'])) 
						{
							$requete1 .= "AND a.seance.type_seance = 'cours' ";
						}
						if(isset($_POST['TD'])) 
						{
							$requete1 .= "AND a.seance.type_seance = 'TD' ";
						}
						if(isset($_POST['TP'])) 
						{
							$requete1 .= "AND a.seance.type_seance = 'TP' ";
						}
					}
				}
			}
		}	
		/*if(isset($_POST['cours'])) {
			$requete1 .= "AND a.seance.type_seance = 'cours' ";
		}
		if(isset($_POST['TD'])) {
			$requete1 .= "AND a.seance.type_seance = 'TD' ";
		}
		if(isset($_POST['TP'])) {
			$requete1 .= "AND a.seance.type_seance = 'TP' ";
		}*/
		if(isset($_POST['justification'])) {
			$requete1 .= "AND a.est_justifie = 0 ";
		}
		$requete1 .= "GROUP BY a.etudiant.num_etud , a.etudiant.nom , a.etudiant.prenom
				      ORDER BY nb_absences DESC , a.etudiant.nom";
				   
		$s1 = oci_parse($c, $requete1);
		$r1 = oci_execute($s1);

		if(!$r1) {
			echo "Problème d'execution de la requete de recuperation des absents";
		} else {
			echo "<table  class='table-bordered'>";
			echo "<tr id='entete'>
					<th>Numéro d'étudiant</th>
					<th>Nom de l'étudiant</th>
					<th>Prénom de l'étudiant</th>
					<th>Nombre d'absences</th>
				  </tr>";
			while ($row1 = oci_fetch_array($s1)) {
				if($row1[3] > 3) {	
					echo "<tr id='plusTrois'>";	
					echo "<td>" . $row1[0] . "</td>";
					echo "<td>" . ucfirst($row1[1]) . "</td>";	
					echo "<td>" . ucfirst($row1[2]) . "</td>";
					echo "<td>" . $row1[3] . "</td>";
					echo "</tr>";
				} else {
					echo "<tr>";	
					echo "<td>" . $row1[0] . "</td>";
					echo "<td>" . ucfirst($row1[1]) . "</td>";	
					echo "<td>" . ucfirst($row1[2]) . "</td>";
					echo "<td>" . $row1[3] . "</td>";
					echo "</tr>";
				}
			}
			echo "</table>";
		}
		//TABLEAU POUR LES PRESENCES
		echo "<hr><h4>Etudiants présents pour tous les Cours dispensés en ".$_POST['listeCours']."</h4>";
		$requete2 = "SELECT i.num_etudiant.num_etud , i.num_etudiant.nom , i.num_etudiant.prenom FROM inscrire i
					WHERE i.matiere.nom_matiere = '".$_POST['listeCours']."' 
						AND i.num_etudiant.ident NOT IN (
							SELECT a.etudiant.ident FROM absence a
							WHERE a.seance.enseignant.ident = ".$_SESSION['IDENT']." 
								AND a.seance.matiere.nom_matiere = '".$_POST['listeCours']."'
							GROUP BY a.etudiant.ident )";

		$s2 = oci_parse($c, $requete2);
		$r2 = oci_execute($s2);		
		
		if(!$r2) {
			echo "Problème d'execution de la requete de recuperation des absents";
		} else {
			echo "<table  class='table-bordered'>";
			echo "<tr id='entete'>
					<th>Numéro de l'étudiant</th>
					<th>Nom de l'étudiant</th>
					<th>Prénom de l'étudiant</th>
				  </tr>";
			while ($row2 = oci_fetch_array($s2)) {
				echo "<tr id='zero'>";	
				echo "<td>" . $row2[0] . "</td>";
				echo "<td>" . ucfirst($row2[1]) . "</td>";	
				echo "<td>" . ucfirst($row2[2]) . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}	
?>
