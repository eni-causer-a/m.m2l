<?php
// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
	
if ( ! isset ($_POST ["btnConfirmerReservation"]) == true) {
// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
$idReservation = '';
include_once ('vues/VueConfirmerReservation.php');
}
else
{
$idReservation = $_POST ["numReservation"];
}
	$nomUtilisateur = $_SESSION['nom'];
	
	
	// On teste si la réservation existe
	if (!$dao->existeReservation($idReservation)){
		$message = "Confirmation impossible, la réservation n'existe pas.";
		$typeMessage = 'avertissement';
		$themeFooter = $themeNormal;
		include_once ('vues/VueConfirmerReservation.php');	
	}
	else{
		// On teste si l'utilisateur est le créateur de la réservation
		if ( !$dao->estLeCreateur($nomUtilisateur,$idReservation)){
			$message = "Confirmation impossible, vous n'êtes pas le créateur.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			include_once ('vues/VueConfirmerReservation.php');
		}
		else{
			if (!$dao->getReservation($idReservation)){
				$message = "Confirmation impossible, reservation inexistante";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
			
				include_once ('vues/VueConfirmerReservation.php');
			}
			
			else {
				$laReservation = $dao->getReservation($idReservation);
				$laDateReservation = $laReservation->getEnd_time();
				
				if ($laDateReservation <= time()){
					$message = "Annulation impossible, la réservation est passée.";
					$typeMessage = 'avertissement';
					$themeFooter = $themeNormal;
					include_once ('vues/VueConfirmerReservation.php');
				}
			
				else {
					// Si la réservation existe et a été faite par l'utilisateur elle est annulée
					$ok = $dao->confirmerReservation($idReservation);
						
					if ($ok) {
						$message = 'Réservation confirmée.';
						$typeMessage = 'information';
						$themeFooter = $themeNormal;
						$dao->creerLesDigicodesManquants();
						include_once ('vues/VueConfirmerReservation.php');
					}
					else {
						$message = 'Cette réservation est déjà confirmée !';
						$typeMessage = 'avertissement';
						$themeFooter = $themeNormal;
						include_once ('vues/VueConfirmerReservation.php');
					}
				}
			}
		}
}