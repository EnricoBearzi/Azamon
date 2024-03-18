<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ordersStyle.css">
    <script src="fetch_orders.js"></script>
    <title>products</title>
  </head>
  <body>
    <h1><button class="back" onclick="location.href = 'ordini.php';">BACK</button>PRODUCTS
    <button class="delete" onclick="location.href = 'ordini.php';">DELETE</button>
    <button class="modify" onclick="location.href = 'ordini.php';">MODIFY</button>
    </h1>
    
    <?php
      session_start();
      $ruolo = 'amministratore';
    ?>

    <?php if($ruolo !== 'amministratore'): ?>
      <div id="user_view" class="nextPage"></div>
      <script>
        fetch_dettagli_ordine_user("API/ordini/dettagli.php?id_ordine="+encodeURIComponent(<?php echo $_GET['id_ordine']?>), "GET")
      </script>
    <?php endif ?>

    <?php if($ruolo == 'amministratore'): ?>
      <div id="admin_view" class="nextPage"></div>
      <script>
        fetch_dettagli_ordine_admin("API/ordini/dettagli.php?id_ordine="+encodeURIComponent(<?php echo $_GET['id_ordine']?>), "GET")
      </script>
    <?php endif ?>
    
  </body>
</html>