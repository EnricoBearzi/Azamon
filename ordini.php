<?php include("./API/ordini/riepilogo.php") ?>

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ordersStyle.css">
    <title>orders</title>
  </head>
  <body>
    <h1><button class="back">BACK</button>ORDERS</h1>

    <!-- Per user -->
    <?php if($ruolo !== 'amministratore'): ?>
      
      <form action="riepilogoOrdini.php" method="GET">
        <input class="searchInput" type="text" name="keyword" id="keyword" placeholder="Inserisci nome prodotto">
        <button class="search" type="submit">Cerca</button>
      </form>

      <?php foreach ($ordini as $ordine): ?>
        <div>
          <p>Nome: <?php echo $ordine['nome_prodotto']; ?></p>
          <p>Quantità: <?php echo $ordine['quantita_totale']; ?></p>
          <p>Prezzo: &euro; <?php echo number_format($ordine['totale_ordine'], 2); ?></p>
        </div>
      <?php endforeach; ?>
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

      <?php foreach ($ordini as $ordine): ?>
        <div>
          <p>Cliente: <?php echo $ordine['nome_cliente']." ".$ordine['cognome_cliente']; ?></p>
          <p id="<?php echo $ordine['id_ordine']; ?>"><?php echo $ordine['numero_ordine']; ?></p>
          <p>Data: <?php echo $ordine['data_ordine']; ?></p>
          <p>Stato: <?php echo $ordine['stato_ordine']; ?></p>
          <p>Quantità: <?php echo $ordine['quantita_totale']; ?></p>
          <p>Prezzo: &euro; <?php echo number_format($ordine['totale_ordine'], 2); ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif ?>

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