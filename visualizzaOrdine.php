<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dettaglio ordine</title>
</head>
<body>
  <h1>Dettaglio ordine</h1>

  <?php

  session_start();

  require_once 'connessione.php';

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
$result = $stmt->get_result();

// Chiudi la prepared statement
$stmt->close();

  if ($ordine = $result->fetch_assoc()) {

    $id_ordine = $ordine['id_ordine'];
    $id_utente = $ordine['id_utente'];
    $nome_cliente = $ordine['nome_cliente'];
    $cognome_cliente = $ordine['cognome_cliente'];
    $email_cliente = $ordine['email_cliente'];
    $data_ordine = $ordine['data_ordine'];
    $stato_ordine = $ordine['stato_ordine'];
    $numero_ordine = $ordine['numero_ordine'];
    $nome_prodotto = $ordine['nome_prodotto'];
    $descrizione_prodotto = $ordine['descrizione_prodotto'];
    $prezzo_prodotto = $ordine['prezzo_prodotto'];
    $quantita_ordinata = $ordine['quantita_ordinata'];

  }else {
    echo "<p>Ordine non trovato.</p>";
  }
  
  ?>

  <p><strong>Numero ordine:</strong> <?php echo $numero_ordine; ?></p>
  <p><strong>Data ordine:</strong> <?php echo $data_ordine; ?></p>
  <p><strong>Stato ordine:</strong> <?php echo $stato_ordine; ?></p>
  <p><strong>Cliente:</strong> <?php echo $nome_cliente . " " . $cognome_cliente; ?></p>
  <p><strong>Email:</strong> <?php echo $email_cliente; ?></p>

  <h2>Prodotti ordinati</h2>

  <table border="1" cellpadding="5">
    <tr>
      <th>Nome prodotto</th>
      <th>Descrizione prodotto</th>
      <th>Prezzo unitario</th>
      <th>Quantità ordinata</th>
      <th>Totale</th>
    </tr>
      <tr>
        <td><?php echo $nome_prodotto; ?></td>
        <td><?php echo $descrizione_prodotto; ?></td>
        <td>&euro; <?php echo number_format($prezzo_prodotto, 2); ?></td>
        <td><?php echo $quantita_ordinata; ?></td>
        <td>&euro; <?php echo number_format($prezzo_prodotto*$quantita_ordinata, 2); ?></td>
      </tr>
  </table>

</body>
</html>
