<?php
	
	include_once ('../modele/Outils.class.php');
	// inclusion des paramètres de l'application
	include_once ('../modele/parametres.localhost.php');
		
	// Récupération des données transmises
	// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
	if ( empty ($_GET ["nom"]) == true)  $nom = "";  else   $nom = $_GET ["nom"];
	if ( empty ($_GET ["mdp"]) == true)  $mdp = "";  else   $mdp = $_GET ["mdp"];
	if ( empty ($_GET ["res"]) == true)  $mdp = "";  else   $res = $_GET ["res"];
	// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
	// la fonction $_POST récupère une donnée envoyées par la méthode POST
	if ( $nom == "" && $mdp == "" || $res == "")
	{	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
		if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
		if ( empty ($_POST ["numReservation"]) == true)  $res = "";  else   $res = $_POST ["numReservation"];
	}
	// Contrôle de la présence des paramètres
	if ( $nom == "" || $mdp == "" || $res == "")
	{	$msg = "Erreur : données incomplètes.";
	}
	else
	{	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
		include_once ('../modele/DAO.class.php');
		$dao = new DAO();
		
		$niveauUtilisateur = $dao->getNiveauUtilisateur($nom, $mdp);
		$unUtilisateur = $dao->getUtilisateur($nom);
		
		if ( $niveauUtilisateur == "inconnu" ) 
		{ 
			$msg = "Erreur : authentification incorrecte.";
		}
			else { 
				$laReservation = $dao->getReservation($res);
					if ($laReservation == null)
					{
						$msg = "Erreur : numéro de réservation inexistant.";
					}
					else {
						$estLeCreateur = $dao->estLeCreateur($nom,$res);
							if ($estLeCreateur == false) 
							{
								$msg = "Erreur : vous n'êtes pas l'auteur de cette réservation.";
							}
							else {
								$leStatus = $laReservation->getStatus();
									if ($leStatus == 0) 
									{
										$msg = "Erreur : cette réservation est déjà confirmée.";
									}
									else {
										$laDate = $laReservation->getStart_time();
											if ($laDate > time())
											{
												$msg = "Erreur : cette réservation est déjà passée.";
											}
											else {
												
												$adrMail = $unUtilisateur->getEmail();
												$password = Outils::creerMdp();
												$dao->modifierMdpUser($nom, $password);
												$level = $dao->getNiveauUtilisateur($nom, $password);
												$laSalle = $laReservation->getRoom_name();
												$leDigicode = $laReservation->getDigicode();
												
												$sujet = "Confirmation de réservation";
												$contenuMail = "Voici les données concernant votre réservation :\n\n";
												$contenuMail .= "Date et heure de la réservation : " . $laDate . "\n";
												$contenuMail .= "La salle : " . $laSalle . "\n";
												$contenuMail .= "Le digicode : " . $leDigicode . "\n";
												
												$ok = Outils::envoyerMail($adrMail, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
												if ( ! $ok ) {
													$dao->confirmerReservation($res);
													$msg = "Enregistrement effectué ; l'envoi du mail de confirmation a rencontré un problème.";
												}
												else {
													$dao->confirmerReservation($res);
													$msg = "Enregistrement effectué ; vous allez recevoir un mail de confirmation.";
												}
													
											}
									}
							}
					}
			}
				
		
		// ferme la connexion à MySQL
		unset($dao);
	}
	// création du flux XML en sortie
	creerFluxXML ($msg, $res);
	// fin du programme (pour ne pas enchainer sur la fonction qui suit)
	exit;
	 
	// création du flux XML en sortie
	function creerFluxXML($msg, $res)
	{	// crée une instance de DOMdocument (DOM : Document Object Model)
		$doc = new DOMDocument();
		
		// specifie la version et le type d'encodage
		$doc->version = '1.0';
		$doc->encoding = 'ISO-8859-1';
		
		// crée un commentaire et l'encode en ISO
		$elt_commentaire = $doc->createComment('Service web ConsulterReservations - BTS SIO - Lycée De La Salle - Rennes');
		// place ce commentaire à la racine du document XML
		$doc->appendChild($elt_commentaire);
		
		// crée l'élément 'data' à la racine du document XML
		$elt_data = $doc->createElement('data');
		$doc->appendChild($elt_data);
		
		// place l'élément 'reponse' dans l'élément 'data'
		$elt_reponse = $doc->createElement('reponse', $msg);
		$elt_data->appendChild($elt_reponse);
		
		// place l'élément 'donnees' dans l'élément 'data'
		$elt_donnees = $doc->createElement('donnees');
		$elt_data->appendChild($elt_donnees);
		
		// Mise en forme finale
		$doc->formatOutput = true;
		
		
		// renvoie le contenu XML
		echo $doc->saveXML();
		return;
	}
	?>