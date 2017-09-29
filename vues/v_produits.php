
<div id="produits">
<table>
<?php
// parcours du tableau contenant les produits à afficherforeach( $lesProduits as $unProduit) 
{ 	// affichage d'un produit avec ses informations
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
	$promo= $unProduit['promo'];
	?>	
	<tr>
			<td><img src="<?php echo $image ?>" alt=image /></td>
			<td><?php echo $description ?></td>
			<td><?php 
			if ($promo>0) echo " : <del>".$prix."</del></td><td>".$prix*(1-$promo/100)." Euros</td>" ;
			else echo " : </td><td>".$prix." Euros</td>" ;?>
			</td>
			
			<td><a href="index.php?uc=voirProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier"> 
			<img src="images/mettrepanier.png" TITLE="Ajouter au panier" alt="Mettre au panier"> </a></td>
			
	</tr>

<?php			
}
?>
</table>
</div>
