<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Reservation.class.php
// Rôle : la classe Reservation représente les réservations de salles
// Création : 5/11/2015 par JM CARTRON
// Mise à jour : 24/5/2016 par JM CARTRON

class Reservation
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	// Rappel : le temps UNIX mesure le nombre de secondes écoulées depuis le 1/1/1970
	// les types des champs timestamp, start_time et end_time découlent des types choisis pour la BDD
	private $id;			// identifiant de la réservation (numéro automatique dans la BDD)
	private $timestamp;		// date et heure de la dernière mise à jour de la réservation (format 'Y-m-d H:i:s')
	private $start_time;	// date de début de la réservation (en temps UNIX)
	private $end_time;		// date de fin de la réservation (en temps UNIX)
	private $room_name;		// nom de la salle réservée
	private $status;		// 0 = réservation confirmée ; 4 = réservation provisoire
	private $digicode;		// digicode d'accès à la salle pour cette réservation uniquement

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Reservation($unId, $unTimeStamp, $unStartTime, $unEndTime, $unRoomName, $unStatus, $unDigicode) {
		$this->id = $unId;
		$this->timestamp = $unTimeStamp;
		$this->start_time = $unStartTime;
		$this->end_time = $unEndTime;
		$this->room_name = $unRoomName;
		$this->status = $unStatus;
		$this->digicode = $unDigicode;
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getTimestamp()	{return $this->timestamp;}
	public function setTimestamp($unTimestamp) {$this->timestamp = $unTimestamp;}
	
	public function getStart_time()	{return $this->start_time;}
	public function setStart_time($unStart_time) {$this->start_time = $unStart_time;}
		
	public function getEnd_time()	{return $this->end_time;}
	public function setEnd_time($unEnd_time) {$this->end_time = $unEnd_time;}

	public function getRoom_name()	{return $this->room_name;}
	public function setRoom_name($unRoom_name) {$this->room_name = $unRoom_name;}
	
	public function getStatus()	{return $this->status;}
	public function setStatus($unStatus) {$this->status = $unStatus;}
	
	public function getDigicode()	{return $this->digicode;}
	public function setDigicode($unDigicode) {$this->digicode = $unDigicode;}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Méthodes d'instances ----------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg = "Réservation : <br>";
		$msg .= "id : " . $this->id . "<br>";
		$msg .= "timestamp : " . $this->timestamp . "<br>";
		$msg .= "start_time : " . date('Y-m-d H:i:s', $this->start_time) . "<br>";
		$msg .= "end_time : " . date('Y-m-d H:i:s', $this->end_time) . "<br>";
		$msg .= "room_name : " . $this->room_name . "<br>";
		$msg .= "status : " . $this->status . "<br>";
		$msg .= "digicode : " . $this->digicode . "<br>";
		return $msg;
	}
	
} // fin de la classe Reservation

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!