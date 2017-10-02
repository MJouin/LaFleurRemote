

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

case 'connexion':
	{
		if (isset($_REQUEST['pseudo']))  {
		$pdo->connexion(htmlentities($_REQUEST['pseudo']), htmlentities($_REQUEST['mdp']));
		}
		if (!dejaConnecte()) {
			$message = "Les infos de connexion sont invalides";
			include ("vues/v_message.php");
			include ("vues/v_connexion.php");
		}

		else {
			
			include ("vues/v_admin.php");
		}

		break;

	}
	}
?>