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

if (!isset($_GET['id_ordine']) || !is_numeric($_GET['id_ordine'])) {
  http_response_code(400); // Richiesta non riconosciuta
  echo json_encode(['Errore' => 'ID ordine non valido']);
  exit;
}

$id_ordine = $_GET['id_ordine'];

$query = 'SELECT * FROM dettagli_ordini WHERE id_ordine = ?';

$stmt = $conn->prepare($query);

$stmt->bind_param('i', $id_ordine);

$stmt->execute();

$dettagli_ordine = $stmt->get_result();

if ($dettagli_ordine === false || $dettagli_ordine->num_rows === 0) {
  http_response_code(500); // Errore interno
  echo json_encode(['Errore' => 'Ordini non trovato']);
  exit;
}

$dettagli_ordine = $dettagli_ordine->fetch_all();

$stmt->close();

echo json_encode($dettagli_ordine);

?>
