<?php
include_once 'assets/psl-config.php'; 

$conn = mysql_connect(HOST, USER, PASSWORD, DATABASE);
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$proname = $_POST["projektname"];
$firmaname = $_POST["erlaubtefirma"];
if (!$fileTmpLoc) { // if file not chosen
    echo "Wählen Sie bitte eine Datei aus";
    exit();
}

$path = 'files/'.$proname;

$sql = "INSERT INTO projekte (name, ordner, erlaubte_firma) VALUES ( '$proname', '$proname', '$firmaname' )";
mysql_select_db(DATABASE);
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
	if ( ! is_dir($path)) {
		mkdir($path);
	}
	if(move_uploaded_file($fileTmpLoc, "files/$proname/$fileName")){
	    echo "$fileName wurde erfolgreich hochgeladen!";
	} else {
	    echo "Datei konnte nich hochgeladen werden";
	}

?>