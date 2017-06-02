<?php
// Service web du projet Réservations M2L
// Ecrit le 22/11/2016 par Tony
// Modifié le
// Ce service web permet d'annuler une reservatio,
// et fournit un compte-rendu d'exécution
// Le service web doit être appelé avec 3 paramètres : nomUser, mdpUser, numReservation
// Les paramètres peuvent être passés par la méthode GET (pratique pour les tests, mais à éviter en exploitation) :
// http://<hébergeur>/CreerUtilisateur.php?nomUser=admin&mdpUser=admin&idReservation=
// Les paramètres peuvent être passés par la méthode POST (à privilégier en exploitation pour la confidentialité des données) :
// http://<hébergeur>/CreerUtilisateur.php
// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/parametres.localhost.php');
// Récupération des données transmises
// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
if (empty ( $_GET ["nomUser"] ) == true)
	$nomUser = "";
else
	$nomUser = $_GET ["nomUser"];
if (empty ( $_GET ["mdpUser"] ) == true)
	$mdpUser = "";
else
	$mdpUser = $_GET ["mdpUser"];
if (empty ( $_GET ["idReservation"] ) == true)
	$idReservation = "";
else
	$idReservation = $_GET ["idReservation"];
	
	// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
	// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ($nomUser == "" && $mdpUser == "" && $idReservation == "") {
	if (empty ( $_POST ["nomUser"] ) == true)
		$nomUser = "";
	else
		$nomUser = $_POST ["nomUser"];
	if (empty ( $_POST ["mdpUser"] ) == true)
		$mdpUser = "";
	else
		$mdpUser = $_POST ["mdpUser"];
	if (empty ( $_POST ["idReservation"] ) == true)
		$idReservation = "";
	else
		$idReservation = $_POST ["idReservation"];
}
// Contrôle de la présence des paramètres.
if ($nomUser == "" || $mdpUser == "" || $idReservation == "") {
	$msg = "Erreur : données incomplètes ou incorrectes.";
} else {
	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('../modele/DAO.class.php');
	$dao = new DAO ();
	$dao->creerLesDigicodesManquants();
	
	if ($dao->getNiveauUtilisateur ( $nomUser, $mdpUser ) == "inconnu") {
		$msg = "Erreur : authentification incorrecte.";
	} else {
		
		if ($dao->existeReservation ( $idReservation ) != true) {
			$msg = "Erreur : numéro de réservation inexistant.";
		} 
		else {
			if ($dao->estLeCreateur ( $nomUser, $idReservation ) != true) {
				$msg = "Erreur : vous n'êtes pas l'auteur de cette réservation.";
			} else {
				
				$laReservation = $dao->getReservation( $idReservation);
				
				$laDateReservation = $laReservation->getStart_time();
				
				
				if ($laDateReservation <= time ()) {
					$msg = "Erreur : cette réservation est déjà passée.";
				}
				else {
						$unUtilisateur = $dao->getUtilisateur($nomUser);
						$adrMail = $unUtilisateur->getEmail();
						$sujet = "Confirmation d'annulation";
						$contenuMail = "Votre réservation a bien été annulée";
						
						$outils = new Outils();
						$ok = $outils->envoyerMail($adrMail, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
					if ( ! $ok ) {
						$dao->annulerReservation($idReservation);
						$msg = "Enregistrement effectué ; l'envoi du mail de confirmation a rencontré un problème.";
					}
					else {
						$dao->annulerReservation($idReservation);
						$msg = "Enregistrement effectué ; vous allez recevoir un mail de confirmation.";
					}
				
				}
				
			}
		}
	}
	unset ( $dao );
}
// création du flux XML en sortie
creerFluxXML ( $msg );
// fin du programme (pour ne pas enchainer sur la fonction qui suit)
exit ();
// création du flux XML en sortie
function creerFluxXML($msg) { // crée une instance de DOMdocument (DOM : Document Object Model)
	$doc = new DOMDocument ();
	
	// specifie la version et le type d'encodage
	$doc->version = '1.0';
	$doc->encoding = 'ISO-8859-1';
	
	// crée un commentaire et l'encode en ISO
	$elt_commentaire = $doc->createComment ( 'Service web CreerUtilisateur - BTS SIO - Lycée De La Salle - Rennes' );
	// place ce commentaire à la racine du document XML
	$doc->appendChild ( $elt_commentaire );
	
	// crée l'élément 'data' à la racine du document XML
	$elt_data = $doc->createElement ( 'data' );
	$doc->appendChild ( $elt_data );
	
	// place l'élément 'reponse' juste après l'élément 'data'
	$elt_reponse = $doc->createElement ( 'reponse', $msg );
	$elt_data->appendChild ( $elt_reponse );
	
	// Mise en forme finale
	$doc->formatOutput = true;
	
	// renvoie le contenu XML
	echo $doc->saveXML ();
	return;
}
