<?php
include_once 'assets/db_connect.php';
include_once 'assets/functions.php';
 
sec_session_start();
?>
<html>
	<head>
		
	</head>
	<body>
            <p>Welcome <?php echo htmlentities($_SESSION['firma']); ?>!</p>
		User Dashboard
		<p>You are currently logged <?php echo $firma ?></p>
		<?php echo htmlentities($_SESSION['project']); ?>

					  <?php

					   $projektordner = $_SESSION['project'];
$ordner = "files/"; 
$alledateien = scandir($ordner."/".$projektordner);
 
	foreach ($alledateien as $datei) {
 
    $dateiinfo = pathinfo($ordner."/".$projektordner."/".$datei);
    
    $size = ceil(filesize($ordner."/".$projektordner."/".$datei)/1048576);
 
    if ($datei != "." && $datei != "..") {
?>
			    <td><?php echo $dateiinfo['basename']; ?></td>
			    
			    <td><a href="<?php echo $dateiinfo['dirname']."/".$dateiinfo['basename'];?>">download</a></td>
			 
			<?php
	};
};

?>

	</body>
</html>	