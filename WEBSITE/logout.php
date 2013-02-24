<?php
	unset($_SESSION['IDENT']);
	unset($_SESSION['NOM']);
	unset($_SESSION['PRENOM']);				
	unset($_SESSION['STATUT']);
	session_destroy();
?>
<script type="text/javascript">
	<!--
	var obj = 'window.location.replace("./login.php");';
	setTimeout(obj,0000);
	-->
</script>
