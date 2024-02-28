<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>
<body>
  <h1>Home</h1>

  <?php

  session_start();

  if (isset($_SESSION['messaggio_registrazione'])) {
    echo "<p style='color: green;'>" . $_SESSION['messaggio_registrazione'] . "</p>";
    unset($_SESSION['messaggio_registrazione']);
  }
  

  if (isset($_SESSION['id_utente'])) {
    // Utente già loggato: mostra pannello di controllo
    echo "<h2>Benvenuto " . $_SESSION['nome'] . " " . $_SESSION['cognome'] . "</h2>";
    echo "<p><a href='logout.php'>Logout</a></p>";
  } else {
    // Utente non loggato: mostra pulsanti login e registrazione
    echo "<p><a href='login.php'>Login</a></p>";
    echo "<p><a href='registrazione.php'>Registrazione</a></p>";
  }

  ?>

</body>
</html>
