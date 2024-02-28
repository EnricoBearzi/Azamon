<?php

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  // Richiesta non valida: reindirizza o mostra un messaggio di errore
  header('Location: home.php');
  exit;
}

// Includi il file di connessione al database
require_once 'connessione.php';

// Avvia la sessione
session_start();

// Controlla se l'utente ha fatto login
if (!isset($_SESSION['id_utente']) || !isset($_GET['id_ordine'])) {
  // Utente non loggato, reindirizza al login
  header('Location: login.php');
  exit;
}

// Recupera l'ID ordine
$id_ordine = $_GET['id_ordine'];

// Crea la query SQL
$query = 'SELECT * FROM dettagli_ordini WHERE id_ordine = ?';

// Prepara la query
$stmt = $conn->prepare($query);

// Esegui il binding del parametro
$stmt->bind_param('i', $id_ordine);

// Esegui la query
$stmt->execute();

// Recupera i risultati
$dettagli_ordine = $stmt->get_result()->fetch_assoc();

// Chiudi la prepared statement
$stmt->close();

// Invia i dati al client come JSON
echo json_encode($dettagli_ordine);

?>
