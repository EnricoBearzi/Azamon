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

$id_utente = $_SESSION['id_utente'];
$ruolo = $_SESSION['ruolo'];

$query = 'SELECT * FROM riepilogo_ordini';

if ($ruolo !== 'amministratore') {
  $query .= ' WHERE id_utente = ?';
}

if(isset($_GET['action']) && isset($_GET['keyword'])){
  $action = $_GET['action'];
  $keyword = '%' . $_GET['keyword'] . '%';
  $query .= " AND {$action} LIKE ?";
}

$stmt = $conn->prepare($query);

if ($ruolo !== 'amministratore') {
  $stmt->bind_param('i', $id_utente);
}

if(isset($action) && isset($keyword)){
  $stmt->bind_param('s', $keyword);
}

$stmt->execute();

$ordini = $stmt->get_result();

if ($ordini === false || $ordini->num_rows === 0) {
  http_response_code(500); // Errore interno
  echo json_encode(['Errore' => 'Ordini non trovato']);
  exit;
}

$ordini = $ordini->fetch_all();

$stmt->close();

echo json_encode($ordini);

?>
