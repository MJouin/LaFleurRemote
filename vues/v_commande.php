﻿<div id="creationCommande">
<form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
   <fieldset>
     <legend>Commande</legend>
		<p>
			<label for="nom">Nom*</label>
			<input id="nom" type="text" name="nom" value="<?php echo $nom ?>" size="30" maxlength="45">
		</p>
		<p>
			<label for="prenom">Prénom*</label>
			<input id="prenom" type="text" name="prenom" value="<?php echo $pre ?>" size="30" maxlength="45">
		</p>
		<p>
			<label for="rue">rue*</label>
			 <input id="rue" type="text" name="rue" value="<?php echo $rue ?>" size="30" maxlength="45">
		</p>
		<p>
         <label for="cp">code postal* </label>
         <input id="cp" type="text" name="cp" value="<?php echo $cp ?>" size="5" maxlength="5">
      </p>
      <p>
         <label for="ville">ville* </label>
         <input id="ville" type="text" name="ville"  value="<?php echo $ville ?>" size="32" maxlength="32">
      </p>
      <p>
         <label for="mail">mail* </label>
         <input id="mail" type="email"  name="mail" value="<?php echo $mail ?>" size ="50" maxlength="50">
      </p> 
	  	<p>
         <input type="submit" value="Valider" name="valider">
         <input type="reset" value="Annuler" name="annuler"> 
      </p>
	  </fieldset>
</form>
</div>





