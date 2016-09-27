<?php
// Projet Réservations M2L - version web mobile
// fichier : vues/dialog_message.php
// Rôle : inclut la division permettant d'afficher un message avec une boîte de dialogue
// Création : 30/5/2016 par JM CARTRON
// Mise à jour : 30/5/2016 par JM CARTRON
?>

		<div data-role="dialog" id="affichage_message" data-close-btn="none">
			<div data-role="header" data-theme="<?php echo $themeFooter; ?>">
				<?php if ($typeMessage == 'avertissement') { ?>
					<h3>Avertissement...</h3>
				<?php } ?>
				<?php if ($typeMessage == 'information') { ?>
					<h3>Information...</h3>
				<?php } ?>
			</div>
			<div data-role="content">
				<p style="text-align: center;">
				<?php if ($typeMessage == 'avertissement') { ?>
					<img src="images/avertissement.png" class="image" />
				<?php } ?>
				
				<?php if ($typeMessage == 'information') { ?>
					<img src="images/information.png" class="image" />
				<?php } ?>
				</p>
				<p style="text-align: center;"><?php echo $message; ?></p>
			</div>
			<div data-role="footer" class="ui-bar" data-theme="<?php echo $themeFooter; ?>">
				<a href="#page_principale" data-transition="<?php echo $transition; ?>">Fermer</a>
			</div>
		</div>