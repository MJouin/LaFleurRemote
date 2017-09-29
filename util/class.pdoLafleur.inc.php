<?php

/** 
* fichier class.pdoLafleur.inc.php
* contient la classe PdoLafleur qui fournit 
* un objet pdo et des méthodes pour récupérer des données d'une BD
 */

 /** 
 * PdoLafleur
 
 * classe PdoLafleur : classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application lafleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 
* @package  Lafleur\util
* @version 2016_v1
* @author M. Jouin
*/


class PdoLafleur
{   	
		/**
		* type et nom du serveur de bdd
		* @var string $serveur
		*/
      	private static $serveur='mysql:host=localhost';
		/**
		* nom de la BD 
		* @var string $bdd
		*/
      	private static $bdd='dbname=lafleur';
		/**
		* nom de l'utilisateur utilisé pour la connexion 
		* @var string $user
		*/   		
      	private static $user='root' ;   
		/**
		* mdp de l'utilisateur utilisé pour la connexion 
		* @var string $mdp
		*/  		
      	private static $mdp='' ;
		/**
		* objet pdo de la classe Pdo pour la connexion 
		* @var string $monPdo
		*/ 		
		private static $monPdo;
		/**
		* utilisé pour savoir si l'objet de la classe Pdo a déjà été créé (ou pas pas créé=null)
		* @var string $monPdoLafleur
		*/ 
		private static $monPdoLafleur = null;
	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 */				
	private function __construct()
	{
    		PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
			PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
	}
	/**
    * destructeur
    */
	public function _destruct(){
		PdoLafleur::$monPdo = null;
	}
	/**
	 * Fonction statique qui crée l'unique instance de la classe
	 *
	 * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
	 * @return PdoLafleur $monPdoLafleur l'unique objet de la classe PdoLafleur
	 */
	public  static function getPdoLafleur()
	{
		if(PdoLafleur::$monPdoLafleur == null)
		{
			PdoLafleur::$monPdoLafleur= new PdoLafleur();
		}
		return PdoLafleur::$monPdoLafleur;  
	}
	/**
	 * Retourne toutes les catégories sous forme d'un tableau associatif
	 *
	 * @return array $lesLignes le tableau associatif des catégories 
	*/
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	/**
	 * Retourne toutes les informations d'une catégorie passée en paramètre
	 *
	 * @param string $idCategorie l'id de la catégorie
	 * @return array $laLigne le tableau associatif des informations de la catégorie 
	*/
	public function getLesInfosCategorie($idCategorie)
	{
		$req = "SELECT * FROM categorie WHERE id='$idCategorie'";
		$res = PdoLafleur::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param string $idCategorie  l'id de la catégorie dont on veut les produits
 * @return array $lesLignes un tableau associatif  contenant les produits de la categ passée en paramètre
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="select * from produit where idCategorie = '$idCategorie'";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param array $desIdProduit tableau d'idProduits
 * @return array $lesProduits un tableau associatif contenant les infos des produits dont les id ont été passé en paramètre
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produit where id = '$unIdProduit'";
				$res = PdoLafleur::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
	/**
	 * Crée une commande 
	 *
	 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
	 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
	 * tableau d'idProduit passé en paramètre
	 * @param string $nom nom du client
	 * @param string $pre prenom du client
	 * @param string $rue rue du client
	 * @param string $cp cp du client
	 * @param string $ville ville du client
	 * @param string $mail mail du client
	 * @param array $lesIdProduit tableau associatif contenant les id des produits commandés
	 * @return boolean true si la commande et le contenu bien enregistrés
	 
	*/
	public function creerCommande($nom,$pre,$rue,$cp,$ville,$mail, $lesIdProduit )
	{   $res=false;
		$req = "select max(id) as maxi from commande";
		$res = PdoLafleur::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		$date = date('Y/m/d');
		$req = "insert into commande values ('$idCommande','$date','$nom','$pre','$rue','$cp','$ville','$mail')";
		$res = PdoLafleur::$monPdo->exec($req);
		// si l'enregistrement de la commande s'est bien passé, on enregistre le contenu
		if ($res){
			foreach($lesIdProduit as $unIdProduit)
			{
				$qte= $_SESSION['qtes'][$unIdProduit];
				$req = "insert into contenir values ('$idCommande','$unIdProduit',$qte)";
				$res = PdoLafleur::$monPdo->exec($req);
			}
		}
		return $res;
	}
}
?>