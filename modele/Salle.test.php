<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Salle.test.php
// Test de la classe Salle.class.php
// Création : 30/9/2015 par JM CARTRON
// Mise à jour : 3/7/2016 par JM CARTRON

// inclusion de la classe Salle
include_once ('Salle.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Salle</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// appel du constructeur et tests des accesseurs (get)
$unId = 5;
$unRoomName = "Multimédia";
$unCapacity = 25;
$unAreaName = "Informatique - multimédia";
$uneSalle = new Salle($unId, $unRoomName, $unCapacity, $unAreaName);

echo ('$id : ' . $uneSalle->getId() . '<br>');
echo ('$room_name : ' . $uneSalle->getRoom_name() . '<br>');
echo ('$capacity : ' . $uneSalle->getCapacity() . '<br>');
echo ('$area_name : ' . $uneSalle->getAreaName() . '<br>');
echo ('<br>');

// tests des mutateurs (set)
$uneSalle->setId(6);
$uneSalle->setRoom_name("Amphithéâtre");
$uneSalle->setCapacity(200);
$uneSalle->setAreaName("Salles de réception");

echo ('$id : ' . $uneSalle->getId() . '<br>');
echo ('$room_name : ' . $uneSalle->getRoom_name() . '<br>');
echo ('$capacity : ' . $uneSalle->getCapacity() . '<br>');
echo ('$area_name : ' . $uneSalle->getAreaName() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ($uneSalle->toString());
?>

</body>
</html>