<?php
if ( ! isset ($_POST ["btnChangerDeMdp"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	
	$mdp = '';
	$mdpConf = '';
	$afficherMdp = 'off';
	
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ('vues/VueChangerDeMdp.php');
	
}
else{
	
	$mdp = $_POST ["txtMotDePasse"];
	$mdpConf = $_POST ["txtMotDePasseConf"];
	
	if($mdp != $mdpConf){
		if ( empty ($_POST ["txtMotDePasseConf"]) == true)  $mdpConf = "";  else   $mdpConf = $_POST ["txtMotDePasseConf"];
		if ( empty ($_POST ["txtMotDePasse"]) == true)  $mdp = "";  else   $mdp = $_POST ["txtMotDePasse"];
		if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = "off";  else   $afficherMdp = $_POST ["caseAfficherMdp"];
		$message = 'Le nouveau mot de passe et<br>sa confirmation sont différents !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		$niveauUtilisateur = '';
		include_once ('vues/VueChangerDeMdp.php');
	}
	else{
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		if ( empty ($_POST ["txtMotDePasseConf"]) == true)  $mdpConf = "";  else   $mdpConf = $_POST ["txtMotDePasseConf"];
		if ( empty ($_POST ["txtMotDePasse"]) == true)  $mdp = "";  else   $mdp = $_POST ["txtMotDePasse"];
		if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = "off";  else   $afficherMdp = $_POST ["caseAfficherMdp"];
		$utilisateur = $_SESSION['nom'];
		
		$dao->modifierMdpUser($utilisateur, $mdpConf);
		$ok = $dao->envoyerMdp($utilisateur, $mdpConf);
		if ($ok == true){
			$message = 'Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation.';
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			$niveauUtilisateur = '';
			include_once ('vues/VueChangerDeMdp.php');
			
		} else {
			$message = "Enregistrement effectué.<br>L'envoi du mail de confirmation a rencontré un problème. ";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			$niveauUtilisateur = '';
			include_once ('vues/VueChangerDeMdp.php');
			
		}
		
	}
		
}