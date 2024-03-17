<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ordersStyle.css">
    <script src='fetch_orders.js'></script>
    <title>orders</title>
  </head>
  <body>
    <h1><button class="back">BACK</button>ORDERS</h1>

    <?php
      session_start();
      $ruolo = 'amministratore';
    ?>

    <!-- Per user -->
    <?php if($ruolo !== 'amministratore'): ?>
      <div id="user_view"></div>
      <script>
        fetch_user("/Azamon/API/ordini/riepilogo.php", "GET");
      </script>
    <?php endif ?>

    <!-- Per admin -->
    <?php if($ruolo == 'amministratore'): ?>
      <form action="riepilogoOrdini.php" method="GET">
        <select class="searchInput" name="action" id="action">
          <option value="numero_ordine">Numero ordine</option>
          <option value="nome_cliente">Nome cliente</option>
          <option value="cognome_cliente">Cognome cliente</option>
        </select>
        <input class="searchInput" type="text" name="keyword" id="keyword" placeholder="Inserisci parola chiave">
        <button class="search" type="submit">Cerca</button>
      </form>
      <div id='admin_view'>
        
      </div>
      <script>
        fetch_admin("/Azamon/API/ordini/riepilogo.php", "GET");
      </script>
    <?php endif ?>

  </body>
</html>