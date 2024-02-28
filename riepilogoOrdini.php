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
if (!isset($_SESSION['id_utente'])) {
  // Utente non loggato, reindirizza al login
  header('Location: login.php');
  exit;
}

// Recupera l'ID utente e il ruolo dalla sessione
$id_utente = $_SESSION['id_utente'];
$ruolo = $_SESSION['ruolo'];

// Crea la query SQL
$query = 'SELECT * FROM riepilogo_ordini';

// Se l'utente non è amministratore, aggiungi la clausola WHERE
if ($ruolo !== 'amministratore') {
  $query .= ' WHERE id_utente = ?';
}

// Se è stata passata un'azione e una parola chiave, aggiungi la clausola WHERE
if(isset($_GET['action']) && isset($_GET['keyword'])){
  $action = $_GET['action'];
  $keyword = '%' . $_GET['keyword'] . '%'; // Aggiungi % per utilizzare LIKE correttamente
  $query .= " AND {$action} LIKE ?";
}

// Prepara la query
$stmt = $conn->prepare($query);

// Se l'utente non è amministratore, esegui il binding del parametro
if ($ruolo !== 'amministratore') {
  $stmt->bind_param('i', $id_utente);
}

// Se sono stati passati action e keyword, esegui il binding del parametro aggiuntivo
if(isset($action) && isset($keyword)){
  $stmt->bind_param('s', $keyword);
}

// Esegui la query
$stmt->execute();

// Recupera i risultati
$ordini = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Chiudi la prepared statement
$stmt->close();

// Invia i dati al client come JSON
echo json_encode($ordini);

?>
