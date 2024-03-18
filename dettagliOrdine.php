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
    <button class="delete" onclick="fetchXURL('API/ordini/elimina.php?id_ordine='+encodeURIComponent(<?php echo $_GET['id_ordine']?>), 'DELETE'); window.location.href = 'ordini.php'">DELETE</button>
    </h1>

    <label for="modify">Change state:</label>
    <select id="modify" name="modify">
      <option value="In corso">In corso</option>
      <option value="Annullato">Annullato</option>
      <option value="Completato">Completato</option>
    </select>
    <button class="modify" onclick="fetchXURL('API/ordini/modifica.php?id_ordine='+encodeURIComponent(<?php echo $_GET['id_ordine']?>)+'&stato_ordine='+encodeURIComponent(document.getElementById('modify').value), 'PATCH'); window.location.href = 'dettagliOrdine.php?id_ordine='+encodeURIComponent(<?php echo $_GET['id_ordine']?>)">MODIFY</button>
    
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