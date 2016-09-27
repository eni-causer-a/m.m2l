<?php
	// Projet Réservations M2L - version web mobile
	// fichier : vues/VueMenu.php
	// Rôle : visualiser le menu de l'utilisateur ou de l'administrateur
	// cette vue est appelée par le contôleur controleurs/CtrlMenu.php
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// écrit par Jim le 12/10/2015
	// modifié par Jim le 28/6/2016
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Connecter" data-ajax="false" data-transition="<?php echo $transition; ?>">Déconnexion</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Utilisateur : <?php echo $nom; ?></h4>
				<ul data-role="listview" data-inset="true">
					<li><a href="index.php?action=ConsulterSalles" data-transition="<?php echo $transition; ?>">Consulter les salles</a></li>
					<li><a href="index.php?action=ConsulterReservations" data-transition="<?php echo $transition; ?>">Consulter mes réservations</a></li>
					<li><a href="index.php?action=ConfirmerReservation" data-transition="<?php echo $transition; ?>">Confirmer une réservation</a></li>
					<li><a href="index.php?action=AnnulerReservation" data-transition="<?php echo $transition; ?>">Annuler une réservation</a></li>
					<li><a href="index.php?action=ChangerDeMdp" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
					<?php if ( $niveauUtilisateur == "administrateur" ) {
						// le menu administrateur possède 2 options supplémentaires ?>
						<li><a href="index.php?action=CreerUtilisateur" data-transition="<?php echo $transition; ?>">Créer un utilisateur</a></li>
						<li><a href="index.php?action=SupprimerUtilisateur" data-transition="<?php echo $transition; ?>">Supprimer un utilisateur</a></li>
					<?php } ?>
				</ul>
				
				<?php if($debug == true) {
					echo "<p>SESSION['nom'] = " . $_SESSION['nom'] . "</p>";
					echo "<p>SESSION['mdp'] = " . $_SESSION['mdp'] . "</p>";
					echo "<p>SESSION['niveauUtilisateur'] = " . $_SESSION['niveauUtilisateur'] . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
	</body>
</html>