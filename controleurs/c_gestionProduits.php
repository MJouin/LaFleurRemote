

<?php
$action = $_REQUEST['action'];
switch($action)
{
	

case 'formConnexion':
	{
		if (!dejaConnecte()) {
			include ("vues/v_connexion.php");
		}

		else {
			
			include ("vues/v_adinistrateur.php");
		}
		break;
	}
}

?>