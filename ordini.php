<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riepilogo ordini</title>
</head>
<body>
  <h1>Riepilogo ordini</h1>

  <?php

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

  ?>

  <form action="riepilogo_ordini.php" method="GET">
    <label for="action">Cerca per:</label>
    <select name="action" id="action">
      <option value="numero_ordine">Numero ordine</option>
      <option value="nome_cliente">Nome cliente</option>
      <option value="cognome_cliente">Cognome cliente</option>
    </select>
    <input type="text" name="keyword" id="keyword" placeholder="Inserisci parola chiave">
    <button type="submit">Cerca</button>
  </form>

  <table border="1" cellpadding="5">
    <tr>
      <th>Nome cliente</th>
      <th>Cognome cliente</th>
      <th>Numero ordine</th>
      <th>Data ordine</th>
      <th>Stato ordine</th>
      <th>Quantità totale</th>
      <th>Totale ordine</th>
    </tr>
    <?php foreach ($ordini as $ordine): ?>
      <tr>
        <td><?php echo $ordine['nome_cliente']; ?></td>
        <td><?php echo $ordine['cognome_cliente']; ?></td>
        <td id="<?php echo $ordine['id_ordine']; ?>"><?php echo $ordine['numero_ordine']; ?></td>
        <td><?php echo $ordine['data_ordine']; ?></td>
        <td><?php echo $ordine['stato_ordine']; ?></td>
        <td><?php echo $ordine['quantita_totale']; ?></td>
        <td>&euro; <?php echo number_format($ordine['totale_ordine'], 2); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <script>
$(document).ready(function() {
  $("tr").click(function() {
    var id_ordine = $(this).attr("id");
    window.location.href = "visualizzaOrdine.php?id_ordine=" + id_ordine;
  });
});
</script>

</body>
</html>
