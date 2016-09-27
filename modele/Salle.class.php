<?php
// Projet Réservations M2L - version web mobile
// fichier : 
// Rôle : 
// Création : 27/09/2016
// Mise à jour : 



class Salle {
	// Eléments de notre panier
	private $id;
	private $room_name;
	private $capacity;
	private $areaName;
	
	public function Salle($unId, $unRoomName, $unCapacity, $unAreaName) {
		$this->id = $unId;
		$this->room_name = $unRoomName;
		$this->capacity = $unCapacity;
		$this->areaName = $unAreaName;		
	}

	// Ajout de $num articles de type $artnr au panier

	public function getId()	{return $this->id;}
	public function setId($unId) {$this->Id = $unId;}
	
	public function getRoom_name()	{return $this->room_name;}
	public function setRoom_name($unRoomName) {$this->room_name = $unRoomName;}
	
	public function getCapacity()	{return $this->capacity;}
	public function setCapacity($unCapacity) {$this->capacity = $unCapacity;}
	
	public function getAreaName()	{return $this->areaName;}
	public function setAreaName($unAreaName) {$this->areaName = $unAreaName;}
	
	
	public function toString() {
	
		$msg = 'Id : ' . $this->getId() . '<br>';
		$msg = 'RoomName : ' . $this->getRoom_name() . '<br>';
		$msg = 'Capacity : ' . $this->getCapacity() . '<br>';
		$msg = 'AreaName : ' . $this->getAreaName() . '<br>';
		$msg = '<br>';

		Return $msg;
	}
	
	

}



// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!