<?php
	// Projet Réservations M2L - version web mobile
	// fichier : vues/VueCreerUtilisateur.php
	// Rôle : visualiser la demande de création d'un nouvel utilisateur
	// cette vue est appelée par le contôleur controleurs/CtrlCreerUtilisateur.php
	// Création : 12/10/2015 par JM CARTRON
	// Mise à jour : 2/6/2016 par JM CARTRON
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
		
		<script>
			// associe une fonction à l'événement pageinit
			$(document).bind('pageinit', function() {
				<?php if ($typeMessage != '') { ?>
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				<?php } ?>
			} );
		</script>
	</head>
	
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Créer un compte utilisateur</h4>
				<form action="index.php?action=CreerUtilisateur" method="post" data-ajax="false">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtName">Utilisateur :</label>
						<input type="text" name="txtName" id="txtName" required placeholder="Entrez le nom de l'utilisateur" value="<?php echo $name; ?>">
					</div>
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtAdrMail">Adresse mail :</label>
						<input type="email" name="txtAdrMail" id="txtAdrMail" required placeholder="Entrez l'adresse mail" value="<?php echo $adrMail; ?>">
					</div>
					<div data-role="fieldcontain">
						<fieldset data-role="controlgroup">
							<legend>Niveau :</legend>
							<input type="radio" name="caseLevel" id="invite" value="0" data-mini="true" <?php if ($level == "0") echo 'checked';?> >
							<label for="invite">Invité</label>
							<input type="radio" name="caseLevel" id="utilisateur" value="1" data-mini="true" <?php if ($level == "1") echo 'checked';?> >
							<label for="utilisateur">Utilisateur</label>
							<input type="radio" name="caseLevel" id="administrateur" value="2" data-mini="true" <?php if ($level == "2") echo 'checked';?> >
							<label for="administrateur">Administrateur</label>
						</fieldset>
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="btnCrerUtilisateur" id="btnCrerUtilisateur" value="Créer l'utilisateur" data-mini="true">
					</div>
				</form>

				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>name = " . $name . "</p>";
					echo "<p>adrMail = " . $adrMail . "</p>";
					echo "<p>level = " . $level . "</p>";
				} ?>
				
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
		<?php include_once ('vues/dialog_message.php'); ?>
		
	</body>
</html>