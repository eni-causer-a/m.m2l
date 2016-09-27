<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Utilisateur.class.php
// Rôle : la classe Utilisateur représente les utilisateurs de l'application
// Création : 5/11/2015 par JM CARTRON
// Mise à jour : 24/5/2016 par JM CARTRON

class Utilisateur
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de l'utilisateur (numéro automatique dans la BDD)
	private $level;				// 0=simple visiteur  1=utilisateur pouvant réserver  2=administrateur
	private $name;				// nom de l'utilisateur
	private $password;			// mot de passe de l'utilisateur
	private $email;				// adresse mail de l'utilisateur
	private $lesReservations;	// la collection des réservations passées par l'utilisateur
	
	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Utilisateur($unId, $unLevel, $unName, $unPassword, $unEmail) {
		$this->id = $unId;
		$this->level = $unLevel;
		$this->name = $unName;
		$this->password = $unPassword;
		$this->email = $unEmail;
		$this->lesReservations = array();
	}	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getLevel()	{return $this->level;}
	public function setLevel($unLevel) {$this->level = $unLevel;}
	
	public function getName()	{return $this->name;}
	public function setName($unName) {$this->name = $unName;}
	
	public function getPassword()	{return $this->password;}
	public function setPassword($unPassword) {$this->password = $unPassword;}
	
	public function getEmail()	{return $this->email;}
	public function setEmail($unEmail) {$this->email = $unEmail;}
	
	public function getLesReservations()	{return $this->lesReservations;}
	
	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function ajouteReservation($uneReservation)
	{	// ajoute l'objet à la liste
		$this->lesReservations[] = $uneReservation;
	}
	public function getLaReservation($i)
	{	// fournit la réservation correspondant à l'index demandé
		return $this->lesReservations[$i];
	}
	public function getNbReservations()
	{	// fournit le nombre de réservations dans la liste
		return sizeof($this->lesReservations);
	}
	public function viderListeReservations()
	{	// vide la collection des réservations
		$this->lesReservations = array();
	}

	public function toString() {
		$msg = 'Utilisateur : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'level : ' . $this->getLevel() . '<br>';
		$msg .= 'name : ' . $this->getName() . '<br>';
		$msg .= 'password : ' . $this->getPassword() . '<br>';
		$msg .= 'email : ' . $this->getEmail() . '<br>';
		$msg .= 'nombre de réservations : ' . $this->getNbReservations() . '<br>';
		$msg .= '<br>';
		
		// ajout des réservations dans la chaîne
		foreach ($this->lesReservations as $uneReservation)
		{	$msg .= $uneReservation->toString();
			$msg .= '<br>';
		}
		return $msg;
	}
	
} // fin de la classe Utilisateur

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!