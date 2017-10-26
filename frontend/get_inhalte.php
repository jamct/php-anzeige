<?php
//Einbinden der Funktionen
include('../functions.php');
if(!isset($_POST['name']) ){
	echo "Geben Sie den Namen des Anzeigeräts an.";
	exit;
}

$clientname = $_POST['name'];
$clientdetails = getAnzeige($clientname);

if(!$clientdetails){
	echo "Das Anzeigerät wurde nicht gefunden.";
	exit;
}
//Aktualisieren des Timestamps
$clientdetails['lastTS'] = time();
setAnzeige($clientname, $clientdetails);


//Rückgabe eines JSONS mit einem Befehl zum harten Reload
if($clientdetails['reload'] == true){
	echo json_encode(array("reload"=>true));
	$clientdetails['reload'] = false;
	setAnzeige($clientname, $clientdetails);
	exit;
}


//Der Inhalt soll immer nach 10 Aufrufen aktualisiert werden. Dafür wird ein Counter hochgezählt. Mit diesem Counter könnte man ebenso eine Schleife mit verschiedenen Inhalten einbauen:

if($clientdetails['counter'] == 10){
	$clientdetails['counter'] = 1;
	setAnzeige($clientname, $clientdetails);
}	

if($clientdetails['counter'] == 1){
	//Der anzuzeigende Inhalt wird ausgelesen und zurückgegeben:
	echo json_encode(array("content"=>$clientdetails['content']));
}
	$clientdetails['counter']++;
	setAnzeige($clientname, $clientdetails);	




?>