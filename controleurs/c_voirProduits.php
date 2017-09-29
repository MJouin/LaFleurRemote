

<?php
initPanier();
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirCategories':
	{
  		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		break;
	}
	case 'voirProduits' :
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
		if (isset($_REQUEST['categorie']))
			$categorie = $_REQUEST['categorie'];
		else $categorie = $pdo->getCategorie();
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits.php");
		break;
	}
	case 'ajouterAuPanier' :
	{
		$idProduit=$_REQUEST['produit'];
		$categorie = $_REQUEST['categorie'];
		ajouterAuPanier($idProduit);
		/* if(!$ok)
		{
			$message = "Cet article est déjà dans le panier !!";
			include("vues/v_message.php");
		}*/
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits.php");
		break;
	}
}
?>

