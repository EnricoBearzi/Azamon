<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ordersStyle.css">
    <script src="fetch_orders.js"></script>
    <title>orders</title>
  </head>
  <body>
    <!-- LOGOUT -->
    <h1><button class="back" onclick="location.href = 'logout.php';">BACK</button>ORDERS</h1>

    <?php
      session_start();
      $ruolo = $_SESSION['ruolo'];
      if ($ruolo === 'amministratore') {
        $opzioniDiRicerca = array('Numero dell\'ordine', 'Nome del cliente');
        $valueDiRicerca = array('numero_ordine', 'nome_cliente');
      } else {
        $opzioniDiRicerca = array('Nome del prodotto');
        $valueDiRicerca = array('nome_prodotto');
      }
    ?>
    <select id="opzioniDiRicerca">
      <?php for ($i = 0; $i < count($opzioniDiRicerca); $i++): ?>
        <option value="<?php echo $valueDiRicerca[$i]; ?>"><?php echo $opzioniDiRicerca[$i]; ?></option>
      <?php endfor; ?>
    </select>

    <input type="text" id="barraDiRicerca">

    <?php if ($ruolo === 'amministratore'): ?>
      <div id="admin_view" class="nextPage"></div>
    <?php else: ?>
      <div id="user_view" class="nextPage"></div>
    <?php endif; ?>

    <script>
      <?php if ($ruolo === 'amministratore'): ?>
        fetch_admin("API/ordini/riepilogo.php", "GET");
      <?php else: ?>
        fetch_user("API/ordini/riepilogo.php", "GET");
      <?php endif; ?>
      document.getElementById('barraDiRicerca').addEventListener('input', function() {
        <?php if ($ruolo === 'amministratore'): ?>
          search_fetch_admin();
        <?php else: ?>
          search_fetch_user();
        <?php endif; ?>
      });
    </script>
  </body>
</html>
