<?php
$servername = 'localhost';
$username = 'ihn_yeh_user_1';
$password = '9bAbCBB1Nc*0lwwG';
$dbname = 'ihn_yeh_db_1';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    session_start();
    $location = 'Location: index.php';
    $error = 'C\'è stato un problema nella connessione al database.';
    if(isset($_SESSION['user_id'])){
        $location = 'Location: dashboard.php';
    }
    $_SESSION['error'] = $error;
    header($location);
    exit;
}