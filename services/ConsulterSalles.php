<?php
 include_once ('../modele/Outils.class.php');
 // inclusion des paramètres de l'application
 include_once ('../modele/parametres.localhost.php');
 	
 // la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
 if ( empty ($_GET ["nom"]) == true)  $nom = "";  else   $nom = $_GET ["nom"];
 if ( empty ($_GET ["mdp"]) == true)  $mdp = "";  else   $mdp = $_GET ["mdp"];
 
 // si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
 // la fonction $_POST récupère une donnée envoyées par la méthode POST
 if ( $nom == "" && $mdp == "" )
 {	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
 	if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
 }
 
 // Contrôle de la présence des paramètres
 if ( $nom == "" || $mdp == "" )
 {	$msg = "Erreur : données incomplètes.";
 }
 else
 {	// connexion du serveur web à la base MySQL
 	include_once ('../modele/DAO.class.php');
 	$dao = new DAO();
 	$niveauUtilisateur = $dao->getNiveauUtilisateur($nom, $mdp);
 	
 	if ( $niveauUtilisateur == "inconnu" ) $msg = "Erreur : authentification incorrecte.";
 	
 	if ( $niveauUtilisateur == "utilisateur" || $niveauUtilisateur == "administrateur" ){
 		// récupération des salles libres depuis la classe DAO
 		$lesSalles = $dao->getLesSalles();
 		
 		// mémorisation du nombre de salles libres
 		$nbReponses = sizeof($lesSalles);
 		
 		$msg = $nbReponses . " salles disponibles en réservation.";
 	}
 			
 	
 	// ferme la connexion à MySQL :
 	unset($dao);
 }
 
 // création du flux XML en sortie
 creerFluxXML ($msg);
 
 // fin du programme (pour ne pas enchainer sur la fonction qui suit)
 exit;
 
 
 // création du flux XML en sortie
 function creerFluxXML($msg)
 {	// crée une instance de DOMdocument (DOM : Document Object Model)
 	$doc = new DOMDocument();
 	
 	// specifie la version et le type d'encodage
 	$doc->version = '1.0';
 	$doc->encoding = 'ISO-8859-1';
 	
 	// crée un commentaire et l'encode en ISO
 	$elt_commentaire = $doc->createComment('Service web Connecter - BTS SIO - Lycée De La Salle - Rennes');
 	// place ce commentaire à la racine du document XML
 	$doc->appendChild($elt_commentaire);
 	
 	// crée l'élément 'data' à la racine du document XML
 	$elt_data = $doc->createElement('data');
 	$doc->appendChild($elt_data);
 	
 	// place l'élément 'reponse' juste après l'élément 'data'
 	$elt_reponse = $doc->createElement('reponse', $msg);
 	$elt_data->appendChild($elt_reponse);
 	
 	// Mise en forme finale
 	$doc->formatOutput = true;
 	
 	// renvoie le contenu XML
 	echo $doc->saveXML();
 	return;
 }
 ?>