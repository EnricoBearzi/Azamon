<?php

require_once '../../connessione.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  http_response_code(405); // Metodo non consentito
  echo json_encode(['Errore' => 'Richiesta non valida']);
  exit;
}

if (!isset($_SESSION['id_utente'])) {
  http_response_code(401); // Non autorizzato
  echo json_encode(['Errore' => 'Accesso negato']);
  exit;
}

if (!isset($_GET['id_prodotto']) || !is_numeric($_GET['id_prodotto'])) {
  http_response_code(400); // Richiesta non riconosciuta
  echo json_encode(['Errore' => 'ID prodotto non valido']);
  exit;
}

$id_prodotto = $_GET['id_prodotto'];

$query = 'SELECT * FROM prodotti WHERE id = ?';

$stmt = $conn->prepare($query);

$stmt->bind_param('i', $id_prodotto);

$stmt->execute();

$dettagli_prodotto = $stmt->get_result();

if ($dettagli_prodotto === false || $dettagli_prodotto->num_rows === 0) {
  http_response_code(500); // Errore interno
  echo json_encode(['Errore' => 'Prodotto non trovato']);
  exit;
}

$dettagli_prodotto = $dettagli_prodotto->fetch_all();

$stmt->close();

echo json_encode($dettagli_prodotto);

?>
