<?php

session_start();

require_once 'connessione.php';

if (isset($_SESSION['id_utente']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: home.php');
  exit;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  unset($_POST['email'],$_POST['password']);
  $stmt = $conn->prepare('SELECT * FROM utenti WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['id_utente'] = $user['id'];
      $_SESSION['nome'] = $user['nome'];
      $_SESSION['cognome'] = $user['cognome'];
      $_SESSION['ruolo'] = $user['ruolo'];

      header('Location: home.php');
      exit;
    } else {
      $_SESSION['errore_login'] = 'Password errata.';
    }
  } else {
    $_SESSION['errore_login'] = 'Email non trovata.';
  }
  header('Location: login.php');
}

?>

