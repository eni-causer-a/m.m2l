<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlDemanderMdp.php
// Rôle : traiter la demande de création d'un nouvel utilisateur
// Création : 21/10/2015 par JM CARTRON
// Mise à jour : 2/6/2016 par JM CARTRON

if ( ! isset ($_POST ["txtRes"]))
{
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$Res = '';
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ('vues/VueConfirmerReservation.php');
}
else 
{
	// récupération des données postées
	if ( empty ($_POST ["txtRes"]) == true)  $Res = "";  else   $Res = $_POST ["txtRes"];
	
	// inclusion de la classe Outils pour utiliser les méthodes statiques estUneAdrMailValide et creerMdp
	include_once ('modele/Outils.class.php');
}
	
if ($Res == '') 
{
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueConfirmerReservation.php');
}
else 
{
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
			
		if ( $dao->existeReservation($Res) == false)
		{
			// si le nom n'existe pas, réaffichage de la vue
			$message = "LA Réservation n'existe pas !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueConfirmerReservation.php');
		}
		if ( $dao->estLeCreateur($_SESSION['nom'],$Res) == false) 
		{
			// si le nom n'existe pas, réaffichage de la vue
			$message = "Vous n'ête pas le créateur de cette réservation !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueConfirmerReservation.php');
		}
		
		$uneReservation=$dao->getReservation($Res);
		
		if($uneReservation->$unStatus == 0)
		{
			$message = "La réservation est déja confirmé";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueConfirmerReservation.php');
		}
		if($uneReservation->$unStartTime < time())
		{
			$message = "La réservation est déja passé";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueConfirmerReservation.php');
		}
		
		$Utilisateur = $dao->getUtilisateur($_SESSION['nom']);
		include_once ('modele/Outils.class.php');
		$Outils = New Outils();
		$sujet = "Confirmez Réservation";
		$messagemail = "Votre confirmation à été prise en compte";
		$EnvoyerMail = $Outils->envoyerMail($resultat->email, $sujet, $messagemail, $adresseEmetteur)
		
//Envoie Mail (Outils.class) les messages ,  Voir avec Getutilisateur pour choper les infos nécessaire
//pas confondre le message de la page et celui du mail
		
}