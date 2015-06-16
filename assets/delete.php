<?php 
include_once 'psl-config.php'; 
$conn = mysql_connect(HOST, USER, PASSWORD, DATABASE);

$projekt = $_GET[project];

$sql = "DELETE FROM projekte WHERE name='".$projekt."'";
mysql_select_db(DATABASE);
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

//echo $projekt;
//$dir = 'samples' . DIRECTORY_SEPARATOR . 'sampledirtree';

$dir = "../files/".$projekt;

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
rmdir($dir);

header('Location: ../admin.php');
?>