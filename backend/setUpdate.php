<?php
//Hinweis: Dieses simple Backend dient nur zu Demo-Zwecken, um das Prinzip vorzustellen. Für den produktiven Einsatz muss es mit einem Passwortschutz versehen werden.

//Einbinden der Funktionen
include('../functions.php');
if(!isset($_POST['display']) ){
	echo "Geben Sie den Namen des Anzeigeräts an.";
	exit;
}

$clientname = $_POST['display'];
$clientdetails = getAnzeige($clientname);

if(!$clientdetails){
	echo "Das Anzeigerät wurde nicht gefunden.";
	exit;
}
//Aktualisieren des Timestamps
$clientdetails['reload'] = true;
$clientdetails['counter'] = 1;
setAnzeige($clientname, $clientdetails);

echo "Das Gerät wird aktualisiert.";

