<?php

function getAnzeige($geraeteID){
	$jsonString = @file_get_contents(__DIR__."/backend/displays/".$geraeteID.".txt");
	if(!strlen($jsonString)){
		return false;
	}
	
	$geraetJson = json_decode($jsonString, true);
	return $geraetJson;
}

function setAnzeige($geraeteID, $content){
	
	$jsonContent = json_encode($content);
	file_put_contents(__DIR__."/backend/displays/".$geraeteID.".txt", $jsonContent);

}

?>