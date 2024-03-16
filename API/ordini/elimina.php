<?php

require_once '../../connessione.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
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

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("DELETE FROM articoli_ordine WHERE ordine_id = ?");
    $stmt->bind_param('i', $id_ordine);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('Articoli ordine non trovato');
    }

    $stmt = $conn->prepare("DELETE FROM ordini WHERE id = ?");
    $stmt->bind_param('i', $id_ordine);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('Ordine non trovato');
    }

    $conn->commit();

    http_response_code(204); // No content
} 
catch (Exception $e) {
    $conn->rollback();
    http_response_code(500); // Errore interno
    echo json_encode(['Errore' => $e->getMessage()]);
} 
finally {
    $stmt->close();
    $conn->close();
}
