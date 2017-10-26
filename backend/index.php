<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Display-Verwaltung</title>
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
	
	<h2>Demo-Backend</h2>
	
<?php
//Hinweis: Dieses simple Backend dient nur zu Demo-Zwecken, um das Prinzip vorzustellen. Für den produktiven Einsatz muss es mit einem Passwortschutz versehen werden.


$alleDisplays = scandir('displays');
 
 if(!count($alleDisplays)){
	 echo "Es wurden keine Display-Definitionen angelegt. Erstellen Sie eine Datei im Ordner 'displays'";
	 exit;
 }
 
 include('../functions.php');
 
foreach ($alleDisplays as $display) { 
	$displayDatei = pathinfo("displays/".$display); 
	
	if($displayDatei['extension'] == "txt"){
		//Es handelt sich um eine Display-Definition
		
		$displayDefinition = getAnzeige($displayDatei['filename']);
		
		if(!$displayDefinition){
			echo "keine gültige Definition für ".$displayDatei['filename'];
			exit;			
		}else{
			
			if($displayDefinition['lastTS'] > time() - 300){
				$farbe = "green";
			}else{
				$farbe = "red";
			}
			
			echo "<table>
					<tr><td>ID: </td><td>".$displayDefinition['id']."</td></tr>
					<tr><td>Name: </td><td>".$displayDefinition['name']."</td></tr>
					<tr><td>Inhalt: </td><td>".$displayDefinition['content']."</td></tr>
					<tr><td>Zuletzt online: </td><td style='color: ".$farbe."'>".date("d.m.Y - H:i:s",$displayDefinition['lastTS'])."</td></tr>
					<tr><td></td><td><button class='btn_aktu' data-display='".$displayDefinition['id']."'>Aktualisieren</button></td></tr>
			</table>";

		}
		
	}
	
	
}
 
?>
<script>
$('.btn_aktu').click(function(){
	var data = $(this).data('display');
	$.post('./setUpdate.php', {display:data}).done(function(data){
		alert(data);
	});
});

</script>
</body>
</html>