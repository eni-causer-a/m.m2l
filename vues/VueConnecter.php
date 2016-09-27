<?php
	// Projet Réservations M2L - version web mobile
	// fichier : vues/VueConnecter.php
	// Rôle : visualiser la vue de connexion d'un utilisateur
	// cette vue est appelée par le contôleur controleurs/CtrlConnecter.php
	// Création : 12/10/2015 par JM CARTRON
	// Mise à jour : 28/6/2016 par JM CARTRON
	/*
	// pour obliger la page à se recharger
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Tranfer-Encoding: none');
	header('Expires: 0');
	*/
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

			// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
			function afficherMdp() {
				// tester si la case est cochée
				if ( $("#caseAfficherMdp").is(":checked") ) {
					// la zone passe en <input type="text">
					$('#txtMotDePasse').attr('type', 'text');
				}
				else {
					// la zone passe en <input type="password">
					$('#txtMotDePasse').attr('type', 'password');
				};
			}
			// fin de la version jQuery
			
			/*
			// version javaScript désactivée
			
			// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
			function afficherMdp()
			{	// document.getElementById("caseAfficherMdp").checked = ! document.getElementById("caseAfficherMdp").checked;
				if (document.getElementById("caseAfficherMdp").checked == true)
					document.getElementById("txtMotDePasse").type="text";
				else
					document.getElementById("txtMotDePasse").type="password";
			}
			
			function initialisation()
			{	afficherMdp();
				document.getElementById("txtMotDePasse").innerText="<?php //echo $mdp; ?>"
			}
			// fin de la version javaScript
			*/
		</script>
	</head>
	
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
			</div>
			
			<div data-role="content">
				<div data-role="collapsible-set">
					<div data-role="collapsible">
						<h3>Bienvenue sur M2L Réservations...</h3>
						<p>L'application de suivi des réservations de la <b>Maison des Ligues de Lorraine (M2L)</b> vous propose les services suivants :</p>
						<ul>
							<li>Consulter la liste des salles</li>
							<li>Consulter vos réservations</li>
							<li>Confirmer une réservation</li>
							<li>Annuler une réservation</li>
							<li>Modifier votre mot de passe</li>
						</ul>
					</div>
			
					<div data-role="collapsible" <?php if($divConnecterDepliee == true) echo ('data-collapsed="false"'); ?>>
						<h3>Accéder à mon compte</h3>
						<form name="form1" id="form1" action="index.php?action=Connecter" data-ajax="false" method="post" data-transition="<?php echo $transition; ?>">
							<div data-role="fieldcontain" class="ui-hide-label">
								<label for="txtNom">Utilisateur :</label>
								<input type="text" name="txtNom" id="txtNom" data-mini="true" placeholder="Mon nom" required value="<?php echo $nom; ?>" >
		
								<label for="txtMotDePasse">Mot de passe :</label>
								<input type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>" name="txtMotDePasse" id="txtMotDePasse" data-mini="true" 
									required placeholder="Mon mot de passe" value="<?php echo $mdp; ?>" >
							</div>														
							<div data-role="fieldcontain" data-type="horizontal" class="ui-hide-label">
								<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
								<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
							</div>
							<div data-role="fieldcontain" style="margin-top: 0px; margin-bottom: 0px;">
								<p style="margin-top: 0px; margin-bottom: 0px;">
									<input type="submit" name="btnConnecter" id="btnConnecter" data-mini="true" data-ajax="false" value="Me connecter">
								</p>
							</div>
						</form>
					</div>						
						
					<div data-role="collapsible" <?php if($divDemanderMdpDepliee == true) echo ('data-collapsed="false"'); ?>>
						<h3>J'ai oublié mon mot de passe</h3>
						<p>Cette option permet de regénérer un nouveau mot de passe qui vous sera immédiatement envoyé par mail.</p>
						<p>Il est conseillé de le changer aussitôt.</p>
						<p style="margin-top: 0px; margin-bottom: 0px;">
							<a href="index.php?action=DemanderMdp" data-role="button" data-mini="true" data-transition="<?php echo $transition; ?>">Obtenir un nouveau mot de passe</a>
						</p>
					</div>

					
					<div data-role="collapsible">
						<h3>Télécharger l'application Android</h3>
						<?php if ($OS == "Android") { ?>
							<p>Vous disposez d'un appareil fonctionnant sous Android.</p>
							<p>Vous pouvez télécharger la version Android de cette application.</p>
							<p style="margin-top: 0px; margin-bottom: 0px;">
								<a href="./controleurs/CtrlTelechargerApk.php" data-role="button" data-mini="true" data-transition="<?php echo $transition; ?>">Télécharger l'application Android</a>
							</p>
						<?php } else {;?>
							<p>Vous ne disposez pas d'un appareil fonctionnant sous Android.</p>
							<p>Vous ne pouvez pas télécharger la version Android de cette application.</p>
						<?php };?>
					</div>
				
				</div>	
				
				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>SESSION['nom'] = " . $_SESSION['nom'] . "<br>";
					echo "SESSION['mdp'] = " . $_SESSION['mdp'] . "<br>";
					echo "SESSION['niveauUtilisateur'] = " . $_SESSION['niveauUtilisateur'] . "<br>";
					echo "SESSION['afficherMdp'] = " . $_SESSION['afficherMdp'] . "<br>";
					echo "nom = " . $nom . "<br>";
					echo "mdp = " . $mdp . "<br>";
					echo "niveauUtilisateur = " . $niveauUtilisateur . "<br>";
					echo "mode = " . $afficherMdp . "</p>";
				} ?>
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
		<?php include_once ('vues/dialog_message.php'); ?>
		
	</body>
</html>