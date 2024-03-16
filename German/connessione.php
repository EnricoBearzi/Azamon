<?php
$servername = '';
$username = '';
$password = '';
$dbname = '';

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