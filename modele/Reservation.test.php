<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Reservation.test.php
// Test de la classe Reservation.class.php
// Création : 30/9/2015 par JM CARTRON
// Mise à jour : 24/5/2016 par JM CARTRON

// inclusion de la classe Reservation
include_once ('Reservation.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Reservation</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unTimeStamp = date('Y-m-d H:i:s', time());		// l'heure courante
$unStartTime = time() + 3600;					// l'heure courante + 1 h
$unEndTime = time() + 7200;						// l'heure courante + 2 h

// appel du constructeur et tests des accesseurs (get)
$uneReservation = new Reservation(10, $unTimeStamp, $unStartTime, $unEndTime, "Salle informatique", 4, "123456");

echo ('$id : ' . $uneReservation->getId() . '<br>');
echo ('$timestamp : ' . $uneReservation->getTimestamp() . '<br>');
echo ('$start_time : ' . date('Y-m-d H:i:s', $uneReservation->getStart_time()) . '<br>');
echo ('$end_time : ' . date('Y-m-d H:i:s', $uneReservation->getEnd_time()) . '<br>');
echo ('$room_name : ' . $uneReservation->getRoom_name() . '<br>');
echo ('$status : ' . $uneReservation->getStatus() . '<br>');
echo ('$digicode : ' . $uneReservation->getDigicode() . '<br>');
echo ('<br>');

// tests des mutateurs (set)
$uneReservation->setId(20);
$uneReservation->setTimestamp(date('Y-m-d H:i:s', time() - 3600));	// l'heure courante - 1 h
$uneReservation->setStart_time(time());								// l'heure courante
$uneReservation->setEnd_time(time() + 3600);						// l'heure courante + 1 h
$uneReservation->setRoom_name("Salle multimédia");
$uneReservation->setStatus(0);
$uneReservation->setDigicode("112233");

echo ('$id : ' . $uneReservation->getId() . '<br>');
echo ('$timestamp : ' . $uneReservation->getTimestamp() . '<br>');
echo ('$start_time : ' . date('Y-m-d H:i:s', $uneReservation->getStart_time()) . '<br>');
echo ('$end_time : ' . date('Y-m-d H:i:s', $uneReservation->getEnd_time()) . '<br>');
echo ('$room_name : ' . $uneReservation->getRoom_name() . '<br>');
echo ('$status : ' . $uneReservation->getStatus() . '<br>');
echo ('$digicode : ' . $uneReservation->getDigicode() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ($uneReservation->toString());
?>

</body>
</html>
