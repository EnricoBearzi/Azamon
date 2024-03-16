<?php

require_once '../../connessione.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
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
$stato_ordine = $_GET['stato_ordine'];

$query = 'UPDATE ordini SET stato = ? WHERE id = ?';

$stmt = $conn->prepare($query);

$stmt->bind_param('si', $stato_ordine, $id_ordine);

$stmt->execute();

if ($stmt->affected_rows === 0) {
    http_response_code(500); // Errore interno
    echo json_encode(['Errore' => 'Ordine non trovato']);
    exit;
}

http_response_code(204); // No content

$stmt->close();

?>
