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

$stmt = $conn->prepare($query);
 
if ($ruolo !== 'amministratore') {
  $stmt->bind_param('s', $id_utente);
}

$stmt->execute();

$ordini = $stmt->get_result();

if ($ordini === false || $ordini->num_rows === 0) {
  http_response_code(500); // Errore interno
  echo json_encode(['Errore' => 'Ordini non trovato']);
  exit;
}

$ordini_array = [];
if ($ruolo !== 'amministratore'){
  while ($ordine = $ordini->fetch_assoc()) {
    $id_ordine = $ordine['id_ordine'];

    $query_prodotti = "SELECT nome_prodotto FROM prodotti_ordine WHERE id_ordine = ?";
    $stmt_prodotti = $conn->prepare($query_prodotti);
    $stmt_prodotti->bind_param('i', $id_ordine);
    $stmt_prodotti->execute();
    $result_prodotti = $stmt_prodotti->get_result();

    $prodotti_array = [];
    while ($prodotto = $result_prodotti->fetch_assoc()) {
        $prodotti_array[] = $prodotto['nome_prodotto'];
    }

    $ordine['prodotti'] = $prodotti_array;

    $ordini_array[] = $ordine;
  }
} else{
  $ordini_array = $ordini->fetch_all();
}

$stmt->close();

echo json_encode($ordini_array);

?>
