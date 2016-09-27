<?php
// ce fichier est destiné à être inclus dans les pages PHP qui ont besoin de se connecter à la base mrbs de GRR
// 2 possibilités pour inclure ce fichier :
//     include_once ('include_parametres.php');
//     require_once ('include_parametres.php');

// paramètres de connexion -----------------------------------------------------------------------------------
global $PARAM_HOTE, $PARAM_PORT, $PARAM_BDD, $PARAM_USER, $PARAM_PWD;
$PARAM_HOTE = "localhost";		// si le sgbd est sur la même machine que le serveur php
$PARAM_PORT = "3306";			// le port utilisé par le serveur MySql
$PARAM_BDD = "mrbs";			// nom de la base de données
$PARAM_USER = "mrbs";			// nom de l'utilisateur
$PARAM_PWD = "mrbs-intra";		// son mot de passe

// Autres paramètres -----------------------------------------------------------------------------------------
global $DELAI_DIGICODE, $ADR_MAIL_EMETTEUR;

// valeur du délai (en secondes) pendant lequel le digicode est accepté avant l'heure de début de réservation
// ou après l'heure de fin de réservation
$DELAI_DIGICODE = 3600;			// 3600 sec ou 1 h

// adresse de l'émetteur lors d'un envoi de courriel
$ADR_MAIL_EMETTEUR = "delasalle.sio.eleves@gmail.com";

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!