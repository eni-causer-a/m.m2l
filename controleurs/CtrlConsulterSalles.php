<?php
if ( $_SESSION['niveauUtilisateur'] != 'utilisateur' && $_SESSION['niveauUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	
	// récupération des salles libres depuis la classe DAO
	$lesSalles = $dao->getLesSalles();
	// mémorisation du nombre de salles libres
	$nbReponses = sizeof($lesSalles);
	// préparation d'un message précédent la liste
	if ($nbReponses == 0) {
		$message = "Il n'y a aucune salle disponible !";
	}
	else {
		$message = $nbReponses . " salle(s) disponibles en réservation :";
	}
	// affichage de la vue
	include_once ('vues/VueConsulterSalles.php');
	unset($dao);		// fermeture de la connexion à MySQL
}