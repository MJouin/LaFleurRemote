<img src="images/panier.gif"	alt="Panier" title="panier"/>
<table>
<?php
$tot=0;
foreach( $lesProduitsDuPanier as $unProduit) 
{
	// récupération des données d'un produit
	$id = $unProduit['id'];
	$description = $unProduit['description'];
	$image = $unProduit['image'];
	$prix = $unProduit['prix'];
	$qte=$_SESSION['qtes'][$id];
	$tot=$prix*$qte;
	// affichage
	?>
	<TR>
	<td><img src="<?php echo $image ?>" alt="image descriptive" width="100"	height="100" /></td>
	<td><?php echo	$description."($prix Euros)";?>	</td>
	<td><a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article?');">
	<img src="images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier"></a></td>
	<td><a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=augmenterQte">
	<img src="images/augmenterQte.png" TITLE="Augmenter la quantité" alt="Augmenter la quantité"></a></td>
	<td><a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=diminuerQte">
	<img src="images/diminuerQte.png" TITLE="Diminuer la quantité" alt="Diminuer la quantité"></a></td>
	<td>Qté : <?php echo $qte;?></td>
	<td>Coût : <?php echo $qte*$prix.'€';?></td>
	</TR>
	<?php
}
?>
<TR><td></td><td></td><td></td><td></td><td></td><td></td><td><?php if ($tot>0) echo'Coût total : '.$tot.'€';?></td></tr>
</table>
<br>
<a href="index.php?uc=gererPanier&action=passerCommande"><img src="images/commander.jpg" TITLE="Passer commande" alt="Commander"></a>
