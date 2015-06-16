<?php 

//DATENBANK-VERBINDUNG AUFBAUEN
include_once 'psl-config.php'; 
$conn = mysql_connect(HOST, USER, PASSWORD, DATABASE);


//PROJEKTNAME ÜBER $_GET-VARIABLE BEZIEHN
$projekt = $_GET[project];


//SQL-BEFEHL UM DATEN AUS DER DATENBANK ZU LÖSCHEN
$sql = "DELETE FROM projekte WHERE name='".$projekt."'";
mysql_select_db(DATABASE);
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}


//ORDNER-PFAD MITTELS PROJEKTNAME FESTLEGEN
$dir = "../files/".$projekt;


//DATEIEN INNERHALB DES ORDNERS LÖSCHEN
$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
$files = new RecursiveIteratorIterator($it,
             RecursiveIteratorIterator::CHILD_FIRST);
foreach($files as $file) {
    if ($file->isDir()){
        rmdir($file->getRealPath());
    } else {
        unlink($file->getRealPath());
    }
}


//DEN ORDNER LÖSCHEN
rmdir($dir);


//REDIRECT ZUM ADMIN-BOARD
header('Location: ../admin.php');
?>