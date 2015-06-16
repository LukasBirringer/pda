<?php 
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // Das gehashte Passwort.
 
    if (login($email, $password, $mysqli) == true) {
        // Login erfolgreich 
        if ($_SESSION['firma'] == 'patrona') {
        	header('Location: ../admin.php');
        } else {
        	header('Location: ../dashboard.php');
        }
        
    } else {
        // Login fehlgeschlagen 
        header('Location: ../index.php?error=1');
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt. 
    echo 'Invalid Request';
}