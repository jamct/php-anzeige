<?php
//Einbinden der Funktionen
include('../functions.php');
if(!isset($_GET['name']) ){
	echo "Geben Sie den Namen des Anzeigeräts an.";
	exit;
}

$clientname = $_GET['name'];
$clientdetails = getAnzeige($clientname);

if(!$clientdetails){
	echo "Das Anzeigerät wurde nicht gefunden.";
	exit;
}

$clientdetails['lastTS'] = time();
$clientdetails['reload'] = false;

setAnzeige($clientname, $clientdetails); 


?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?=$clientdetails['name'];?></title>
        <meta name="description" content="">
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <style>
    body{
		margin:0px;
		padding:0px;
        height:100%;
        font-family:sans-serif;
    }
	#vollbild{
		height:100%;
		position:absolute;
		top:0px;
		left:0px;
		right:0px;
		bottom:0px;
		overflow:hidden;
	}
       
    </style>
    
    <body>  
		<input type="hidden" id="inp_name" value="<?=$clientname;?>"/>
        <div id="vollbild">
    
        </div>

    <script>
        $(function(){
            
        
	function Poll(){
		var name = $('#inp_name').val();
		 $.post("./get_inhalte.php", {name:name}).done(function(returnVal){
			 var returnObject = $.parseJSON(returnVal);
			 
			 if(returnObject.reload == true){
				location.reload();
			 }else{
				 $('#vollbild').load("./content/"+returnObject.content+".php");
				 
			 }

		 });
		setTimeout(Poll,15000);    
	}
	Poll();
    
            
        });
        
        
        </script>     
    </body>
</html>
