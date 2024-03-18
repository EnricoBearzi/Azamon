<?php

session_start();

require_once 'connessione.php';

if (isset($_SESSION['id_utente']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: index.php');
  exit;
}

if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password'])) {
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  unset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password']);
  $stmt = $conn->prepare('SELECT * FROM utenti WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_row();
  $stmt->close();

  print_r($result);

  if ($result[0] > 0) {
    $_SESSION['errore_registrazione'] = 'Email già esistente.';
    header('Location: index.php');
  } else {
    $stmt = $conn->prepare('INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $nome, $cognome, $email, $password);
    $stmt->execute();
    $stmt->close();

    $_SESSION['messaggio_registrazione'] = 'Registrazione avvenuta correttamente. Effettua il login.';
    header('Location: index.php');
  }
}

?>
