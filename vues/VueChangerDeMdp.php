<?php
	// Projet Réservations M2L - version web mobile
	// fichier : vues/VueChangerDeMdp.php
	// Rôle : visualiser la demande de changement de mdp 
	// cette vue est appelée par le contôleur controleurs/CtrlChangerDeMdp.php
	// Création : 04/10/2016 par Tony Bray

?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
		
		<script>
		// version jQuery activée
		
		// associe une fonction à l'événement pageinit
		$(document).bind('pageinit', function() {
			// l'événement "click" de la case à cocher "caseAfficherMdp" est associé à la fonction "afficherMdp"
			$('#caseAfficherMdp').click( afficherMdp );
			
			// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
			afficherMdp();
			
			// affichage du dernier mot de passe saisi (désactivé ici, car effectué dans le code HTML du formulaire)
			// $('#txtMotDePasse').attr('value','<?php echo $mdp; ?>');
			
			<?php if ($typeMessage != '') { ?>
				// affiche la boîte de dialogue 'affichage_message'
				$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
			<?php } ?>
		} );

		function afficherMdp() {
			// tester si la case est cochée
			if ( $("#caseAfficherMdp").is(":checked") ) {
				// la zone passe en <input type="text">
				$('#txtMotDePasse').attr('type', 'text');
				$('#txtMotDePasseConf').attr('type', 'text');
			}
			else {
				// la zone passe en <input type="password">
				$('#txtMotDePasse').attr('type', 'password');
				$('#txtMotDePasseConf').attr('type', 'password');
			};
		}
		</script>
	</head>
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Modifier mon mot de passe</h4>
				<form action="index.php?action=ChangerDeMdp" method="post" data-ajax="false">
					<div data-role="fieldcontain">
						<label for="txtMdp">Nouveau mot de passe :</label>
						<input type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>" name="txtMotDePasse" id="txtMotDePasse" required placeholder="Mon nouveau mot de passe" value="<?php echo $mdp; ?>">
					</div>
					<div data-role="fieldcontain">						
						<label for="txtMdpConfirmation">Confirmation nouveau mot de passe :</label>
						<input type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>" name="txtMotDePasseConf" id="txtMotDePasseConf" required placeholder="Confirmation de mon nouveau mot de passe" value="<?php echo $mdpConf;?>">
					</div>
					<div data-role="fieldcontain" data-type="horizontal" class="ui-hide-label">
						<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>  >
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="btnChangerDeMdp" id="btnChangerDeMdp" value="Envoyer les données" data-mini="true">
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