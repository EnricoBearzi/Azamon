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

if ($ruolo == 'amministratore') {
    if (isset($_GET['action'])) {
        $query .= " WHERE " . $_GET['action'] . " LIKE ?";
    }
} else {
    if (isset($_GET['action'])) {
        $query = 'SELECT riepilogo_ordini.* FROM riepilogo_ordini 
                  INNER JOIN dettagli_ordini ON riepilogo_ordini.id_ordine = dettagli_ordini.id_ordine 
                  WHERE dettagli_ordini.nome_prodotto LIKE ? AND dettagli_ordini.id_utente = ?';
    }
}

$stmt = $conn->prepare($query);

// Esegui la query
if (isset($_GET['action'])) {
    $parameter = '%' . $_GET['keyword'] . '%';
    $stmt->bind_param('s', $parameter);
} elseif (isset($_GET['action'])) {
    $nome_prodotto = '%' . $_GET['keyword'] . '%';
    $stmt->bind_param('si', $nome_prodotto , $id_utente);
}


$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
  http_response_code(500); // Errore interno
  echo json_encode(['Errore' => 'Ordini non trovato']);
  exit;
}

$ordini = [];
while ($ordine = $result->fetch_assoc()) {
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

    $ordini[] = $ordine;
}

echo json_encode($ordini);

$stmt->close();

?>
