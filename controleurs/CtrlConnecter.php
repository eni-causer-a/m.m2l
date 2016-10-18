<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlConnecter.php
// Rôle : traiter la demande de connexion d'un utilisateur
// Création : 12/11/2015 par JM CARTRON
// Mise à jour : 30/5/2016 par JM CARTRON

// Ce contrôleur vérifie l'authentification de l'utilisateur
// si l'authentification est bonne, il affiche le menu utilisateur ou administrateur (vue VueMenu.php)
// si l'authentification est incorrecte, il réaffiche la page de connexion (vue VueConnecter.php)

// on teste si le terminal client est sous Android, pour lui proposer de télécharger l'application Android
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

if ( $detect->isAndroidOS() ) $OS = "Android"; else $OS = "autre";

$divConnecterDepliee = true;		// indique si la division doit être dépliée à l'affichage de la vue
$divDemanderMdpDepliee = false;		// indique si la division doit être dépliée à l'affichage de la vue

if ( ! isset ($_POST ["btnConnecter"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = '';
	$mdp = '';
	$afficherMdp = 'off';
	$niveauUtilisateur = '';
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ('vues/VueConnecter.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtMotDePasse"]) == true)  $mdp = "";  else   $mdp = $_POST ["txtMotDePasse"];
	if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = "off";  else   $afficherMdp = $_POST ["caseAfficherMdp"];
	
	if ($nom == '' || $mdp == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		$niveauUtilisateur = '';
		include_once ('vues/VueConnecter.php');
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		
		// test de l'authentification de l'utilisateur
		// la méthode getNiveauUtilisateur de la classe DAO retourne les valeurs 'inconnu' ou 'utilisateur' ou 'administrateur'
		$niveauUtilisateur = $dao->getNiveauUtilisateur($nom, $mdp);

		$_SESSION['nom'] = $nom;
		$_SESSION['mdp'] = $mdp;
		$_SESSION['niveauUtilisateur'] = $niveauUtilisateur;
		$_SESSION['afficherMdp'] = $afficherMdp;
		
		unset($dao);		// fermeture de la connexion à MySQL
		
		if ( $niveauUtilisateur == "inconnu" ) {
			// si l'authentification est incorrecte, retour à la vue de connexion
			$message = 'Authentification incorrecte !';
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueConnecter.php');
		}
		else {
			// si l'authentification est correcte, redirection vers la page de menu
			header ("Location: index.php?action=Menu");
		}
	}
}