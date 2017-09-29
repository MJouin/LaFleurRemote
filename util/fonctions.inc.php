<?php
/**
* fichier qui contient les fonctions qui ne font pas accès aux données de la BD

* regroupe les fonctions pour gérer le panier, et les erreurs de saisie dans le formulaire de commande

* @package  Lafleur\util
* @version 2016_v1

*/
/**
 * Initialise le panier
 *
 * Crée les tableaux associatifs $_SESSION['produits'] et $_SESSION['qtes'] en session dans le cas
 * où il n'existe pas déjà
*/
function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
		$_SESSION['qtes']= array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime les tableaux associatifs $_SESSION['produits'] et $_SESSION['qtes']
 */
function supprimerPanier()
{
	
	unset($_SESSION['produits']);
	unset($_SESSION['qtes']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé sinon augmente la qte de 1
 
 * @param string $idProduit identifiant de produit
*/
function ajouterAuPanier($idProduit)
{
	if(in_array($idProduit,$_SESSION['produits']))
	{
		$_SESSION['qtes'][$idProduit]++;
	}
	else
	{
		$_SESSION['produits'][]= $idProduit;
		$_SESSION['qtes'][$idProduit]=1; /* qté par défaut lors de l ajout de l article au panier */
	}
}
/**
 * Augmenter de 1 la quantité d un article du panier

 * @param string $idProduit identifiant de produit
 */
function augmenteQte($idProduit)
{
	$_SESSION['qtes'][$idProduit]++;
}
/**
 * Diminue de 1 la quantité d un article du panier

 * @param string $idProduit identifiant de produit
 */
function diminueQte($idProduit)
{
	$_SESSION['qtes'][$idProduit]--;
	if ( $_SESSION['qtes'][$idProduit] ==0)
		retirerDuPanier($idProduit);
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 
 * @return array $_SESSION['produits'] le tableau des id produits du panier 
*/
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];

}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 
 * @return int $n
*/
function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits']))
	{
	$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 
 * @param string $idProduit identifiant de produit
 
*/
function retirerDuPanier($idProduit)
{
		$index =array_search($idProduit,$_SESSION['produits']);
		unset($_SESSION['produits'][$index]);
		unset($_SESSION['qtes'][$idProduit]);
}
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 
 * @param string $codePostal  la chaîne testée
 * @return boolean $ok vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 
 * @param string $valeur la chaîne testée
 * @return boolean $ok vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 
 * @param string $mail la chaîne testée
 * @return boolean $ok vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param string $nom  chaîne testée
 * @param  string $rue chaîne
 * @param string $ville chaîne
 * @param string $cp chaîne
 * @param string $mail  chaîne 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
*/
function getErreursSaisieCommande($nom,$pre,$rue,$ville,$cp,$mail)
{
	$lesErreurs = array();
	if($nom=="")
	{
		$lesErreurs[]="Il faut saisir le nom";
	}
	if($pre=="")
	{
		$lesErreurs[]="Il faut saisir le prénom";
	}
	if($rue=="")
	{
	$lesErreurs[]="Il faut saisir la rue";
	}
	if($ville=="")
	{
		$lesErreurs[]="Il faut saisir la ville";
	}
	if($cp=="")
	{
		$lesErreurs[]="Il faut saisir le Code postal";
	}
	else
	{
		if(!estUnCp($cp))
		{
			$lesErreurs[]= "erreur de code postal";
		}
	}
	if($mail=="")
	{
		$lesErreurs[]="Il faut saisir le mail";
	}
	else
	{
		if(!estUnMail($mail))
		{
			$lesErreurs[]= "erreur de mail";
		}
	}
	return $lesErreurs;
}
?>
