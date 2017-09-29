
<div id="produits">
<table>
<?php
// parcours du tableau contenant les produits à afficherforeach( $lesProduits as $unProduit) 
{ 	// affichage d'un produit avec ses informations
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
	?>	
	<tr>
			<td><img src="<?php echo $image ?>" alt=image /></td>
			<td><?php echo $description ?></td>
			<td><?php echo " : ".$prix." Euros" ?>
			<td><a href="index.php?uc=voirProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier"> 
			<img src="images/mettrepanier.png" TITLE="Ajouter au panier" alt="Mettre au panier"> </a></td>
			
	</tr>

<?php			
}
?>
</table>
</div>
