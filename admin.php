<?php
include_once 'assets/db_connect.php';
include_once 'assets/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/admin.css"><script src="js/jquery.js"></script>
  <title>Patrona Download-Plattform</title>  
	</head>

<body>
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	var projektname = _("projekt-name").value;
	var erlaubtefirma =_("projekt-erlaubte-firma").value;
	


	//alert(erlaubtefirma);
	// alert(file.name+" | "+file.size+" | "+file.type);

	var formdata = new FormData();

	
	formdata.append("file1", file);
	formdata.append("projektname", projektname);
	formdata.append("erlaubtefirma", erlaubtefirma);

	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var loadedmb = Math.round(event.loaded/(1024*1024), 2);
	var totalmb = Math.round(event.total/(1024*1024), 2);

	_("loaded_n_total").innerHTML = +loadedmb+" MB von "+totalmb+" MB hochgeladen";
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% hochgeladen... bitte warten";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

</script>
<div class="newproject">
	<div class="np-modal">
		<a class="np-modal-close" href="#">X</a>
			<div>
				<form id="upload_form" enctype="multipart/form-data" method="post" class="npform" name="upload_form">
			<h3>Neues Projekt anlegen</h3>
					<label for="projekt-erlaubte-firma">Firma/User</label><br>
					<select name="projekt-erlaubte-firma" id="projekt-erlaubte-firma">
						<option>Heino</option>
				    <option>Michael Jackson</option>
				    <option>Tom Waits</option>
				    <option>Nina Hagen</option>
				    <option>Marianne Rosenberg</option>
					</select><br>
			
					<label for="projekt-name">Projektname</label><br>
					<input type="text" id="projekt-name" name="projekt-name"><br>
					
					<label for="file1">Dateien auswählen (1 .zip-Datei auswählen)</label><br>
					<input type="file" name="file1" id="file1"><br>
					  <input type="button" value="Datei hochladen" onclick="uploadFile()">
					  <progress id="progressBar" class="progressbar" value="0" max="100"></progress>
					  <h3 id="status"></h3>
					  <p id="loaded_n_total"></p>

					<input type="submit" value="speichern">
				</form>
			</div>
	</div>
</div>	
<script>
$(document).ready(function()
{
	$("#fileuploader").uploadFile({
	url:"YOUR_FILE_UPLOAD_URL",
	fileName:"myfile"
	});
});
</script>
<section class="top-bar">
	<div class="fix-width">
		<img class="logo" src="img/logo.png" alt="">
		<!--<span>Download-Plattform</span>-->
		<a href="assets/logout.php"><button>Logout</button></a>
		<span class="welcome">Herzlich Willkommen, <i><?php echo htmlentities($_SESSION['username']) ?></i></span>
	</div>
</section>
<section class="sectionhead">
	<div class="fix-width">
		<h1>Administrator Dashboard</h1>
		<a href="user-settings.php"><button class="dlall">User-Einstellungen</button></a>
	</div>
</section>
<section class="files">


		<div class="fix-width">
			
			  <?php
$ordner = "files/"; 
$alledateien = scandir($ordner);

	foreach ($alledateien as $datei) {
 
    $dateiinfo = pathinfo($ordner."/".$datei);
    
    $size = filesize($ordner."/".$datei);
 
    if ($datei != "." && $datei != ".." && $datei !=".DS_Store") {
?>
			 <div class="box">
			 	<div class="p-logo">
			 	<img src="img/<?php echo $dateiinfo['basename']; ?>.jpg" alt="">
			 		
			 	</div>
			 	<div class="p-info">
			 	<p><?php echo $dateiinfo['basename']; ?></p>
			 	<p class="a-info">Erstellt am: <i>13.06.2015</i></p>
			 	<p class="a-info">Größe: <i><?php echo $size; ?> GigaByte</i></p>
			 		<a href="admin-project.php?project=<?php echo $dateiinfo['basename']; ?>"><button>Bearbeiten</button></a>
			 		<button class="delete-btn" id="<?php echo $dateiinfo['basename']; ?>">Löschen</button>
			 	</div>
			 	<div class="delete-overlay<?php echo $dateiinfo['basename']; ?>" id="delete-overlay">
					<div class="delete-modal">
					<h2>Wollen Sie <?php echo $dateiinfo['basename']; ?> wirklich löschen?</h2>
					
					<button class="dm-close">Abbrechen</button>
					<a href="assets/delete.php?project=<?php echo $dateiinfo['basename']; ?>"><button>Löschen</button></a>
					</div>
				</div>	
			 </div>
			    
			    

			<?php  
	};
};
?>
<div class="box np"><p>Neues Projekt</p></div>


<!--Cody House Start-->

<!-- Cody House End -->
		</div>


</section>

<script>
  $( ".newproject" ).hide();
	$( ".np" ).click(function() {
  $( ".newproject" ).fadeIn();
});
$(".np-modal-close").click(function() {
	$(".newproject").fadeOut();
});

//name^='news'
	$("div[class^='delete-overlay']").hide();
  //$( ".delete-overlay*" ).hide();
$( ".delete-btn" ).click(function() {
	var select = $(this);
    var id = select.attr('id');
    window.globalVar = id;
	//$('div.'+id).fadeIn();
  	$( ".delete-overlay"+id ).fadeIn();
});
$(".dm-close").click(function() {
	$( ".delete-overlay"+globalVar ).fadeOut();
});

</script>
	
</body>

<!--
<?php if ($handle = opendir('./files')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "$entry\n";
        }
    }

    closedir($handle);
} ?>  -->


</html>
