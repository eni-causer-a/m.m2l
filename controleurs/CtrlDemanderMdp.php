<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlDemanderMdp.php
// Rôle : traiter la demande de création d'un nouvel utilisateur
// Création : 21/10/2015 par JM CARTRON
// Mise à jour : 2/6/2016 par JM CARTRON

if ( ! isset ($_POST ["txtName"]))
{
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$name = '';
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ('vues/VueDemanderMdp.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtName"]) == true)  $name = "";  else   $name = $_POST ["txtName"];
	
	// inclusion de la classe Outils pour utiliser les méthodes statiques estUneAdrMailValide et creerMdp
	include_once ('modele/Outils.class.php');
	
	if ($name == '') {
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueDemanderMdp.php');
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
			
		if ( $dao->existeUtilisateur($name) == false)
		{
			// si le nom n'existe pas, réaffichage de la vue
			$message = "Nom d'utilisateur inexistant !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueDemanderMdp.php');
		}
		else {
				// récupération de l'adresse mail de l'utilisateur
				$unUtilisateur = $dao->getUtilisateur($name);
				$adrMail = $unUtilisateur->getEmail();		
				
				// création d'un mot de passe aléatoire de 8 caractères
				$password = Outils::creerMdp();
				
				$dao->modifierMdpUser($name, md5($password));
				$dao->envoyerMdp($name, $password);
				$ok = $dao->envoyerMdp($name, $password);
				if ($ok)
				{
					// tout a fonctionné
					$message = "Vous allez recevoir un mail<br/>avec votre nouveau mot de passe.";
					$typeMessage = 'information';
					$themeFooter = $themeNormal;
					include_once ('vues/VueDemanderMdp.php');
				}
				else
				{
					$message = "Echel lors de l'envoi du mail !";
					$typeMessage = 'avertissement';
					$themeFooter = $themeProbleme;
					include_once ('vues/VueDemanderMdp.php');
				}
			}
		unset($dao);		// fermeture de la connexion à MySQL
	}
}
