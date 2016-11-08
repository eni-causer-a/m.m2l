<?php
// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
	
if ( ! isset ($_POST ["btnAnnulerReservation"]) == true) {
// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur

$idReservation = '';
include_once ('vues/VueAnnulerReservation.php');

}
else
{
	$idReservation = $_POST ["txtReservation"];
	$nomUtilisateur = $_SESSION['nom'];
	
	
	// On teste si la réservation existe
	if (!$dao->existeReservation($idReservation)){
		$message = "Annulation impossible, la réservation n'existe pas.";
		$typeMessage = 'avertissement';
		$themeFooter = $themeNormal;
		include_once ('vues/VueAnnulerReservation.php');	
	}
	else {

		
		$laReservation = $dao->getReservation($idReservation);
		$laDateReservation = $laReservation->getEnd_time();		
		
		if ($laDateReservation <= time()){
			$message = "Annulation impossible, la réservation est passée.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			include_once ('vues/VueAnnulerReservation.php');
		}
		else{
			// On teste si l'utilisateur est le créateur de la réservation
			if ( !$dao->estLeCreateur($nomUtilisateur,$idReservation)){
				$message = "Annulation impossible, vous n'êtes pas le créateur.";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ('vues/VueAnnulerReservation.php');
			}
		
			else {
				// Si la réservation existe et a été faite par l'utilisateur elle est annulée
				$ok = $dao->annulerReservation($idReservation);
				
				if ($ok) {
					$message = 'Réservation annulée.';
					$typeMessage = 'information';
					$themeFooter = $themeNormal;
					include_once ('vues/VueAnnulerReservation.php');
				}
			}
		}
		
	}
}