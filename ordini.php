<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ordersStyle.css">
    <script src='fetch_orders.js'></script>
    <script src='passa.js' defer></script>
    <title>orders</title>
  </head>
  <body>
    <!-- LOGOUT -->
    <h1><button class="back" onclick="location.href = 'logout.php';">BACK</button>ORDERS</h1>

    <?php
      session_start();
      $ruolo = 'amministratore';
    ?>

    <!-- Per user -->
    <?php if($ruolo !== 'amministratore'): ?>
      <div id="user_view" class="nextPage"></div>
      <script>
        fetch_user("/azamon/API/ordini/riepilogo.php", "GET").then(function caricaScript(){next()})
      </script>
    <?php endif ?>

    <!-- Per admin -->
    <?php if($ruolo == 'amministratore'): ?>
      <form action="/azamon/API/ordini/search.php" method="GET">
        <select class="searchInput" name="action" id="action">
          <option value="numero_ordine">Numero ordine</option>
          <option value="nome_cliente">Nome cliente</option>
          <option value="cognome_cliente">Cognome cliente</option>
        </select>
        <input class="searchInput" type="text" name="keyword" id="keyword" placeholder="Inserisci parola chiave">
        <button class="search" type="submit">Cerca</button>
      </form>
      <div id='admin_view' class="nextPage">
        
      </div>
      <script>
        fetch_admin("/azamon/API/ordini/riepilogo.php", "GET").then(function caricaScript(){next()})
      </script>
    <?php endif ?>

  </body>
</html>