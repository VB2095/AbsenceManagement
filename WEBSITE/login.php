<?php session_start(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Gestion des absences des étudiants de l'INSA Toulouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
	<?php 
	$c = oci_connect("system", "toto31150", "localhost/XE");
	if(!$c) {
		echo "Problème de connection avec la base de données";
	} else { ?>
	
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Gestion des absences des étudiants de l'INSA Toulouse</a>
                    <div class="nav-collapse collapse">
                        <form action='login.php' class="navbar-form pull-right" method=post>
                            <input name='idUser' class="span2" type="text" placeholder="Identifiant">
                            <input name='passwordUser' class="span2" type="password" placeholder="Mot de passe">
                            <button name="login"  type="submit" class="btn">Connexion</button>
                        </form>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
		<?php
            if (isset($_POST["login"])) {
                $requete = "SELECT ident FROM users 
                                    WHERE login = "."'" . $_POST['idUser'] . "'"." 
                                    AND password = "."'" . $_POST['passwordUser'] . "'"."";

                $s = oci_parse($c, $requete);
                $r = oci_execute($s);

                if(!$r) {
                    echo "Problème d'execution de la requete de connection";
                } else {
                    $row = oci_fetch_array($s);
                    if($row == 0) {
                        echo "Identifiants non valide";               
                    } else {	
						//Je sauvegarde l'ID de la personne connecté
						$id_current = $row['IDENT'] ;
						//Je dois ensuite retrouver le statut de la personne
						$statut_array = array (
							1 => 'ATER',
							2 => 'Permanent_enseignant',
							3 => 'Vacataire',
							4 => 'Etudiant',
							5 => 'Secretaire');
						
						foreach($statut_array as $statut_current) {
						
							$requete = "SELECT ident , nom , prenom FROM ".$statut_current."
										WHERE ident = ". $id_current ;
							$s = oci_parse($c, $requete);
							$r = oci_execute($s);
							if(!$r) {
								echo "Problème de la requête d'identification de la personne";
							} else {
								$row = oci_fetch_array($s);
								if($row != 0) {
									$_SESSION['IDENT'] = $row['IDENT'];
									$_SESSION['PRENOM'] = $row['PRENOM'];
									$_SESSION['NOM'] = $row['NOM'];
									$_SESSION['STATUT'] = $statut_current;
								}
							}									
						}
										
						?>
						<script type="text/javascript">
						<!--
						var obj = 'window.location.replace("./welcome.php");';
						setTimeout(obj,0000);
						-->
						</script>
						<?php
                    }
                }
            }
        }
        ?>
		<div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
                <h1>Bienvenue !</h1>
                <p>Voici le site internet pour le projet de MDSI de 4ème année Informatique à l'INSA de Toulouse.</p>
            </div>

            <hr>

            <footer>
                <p>&copy; Thomas Carayol & Adrien Gareau : Projet MDSI 2013</p>
            </footer>

        </div> <!-- /container -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

