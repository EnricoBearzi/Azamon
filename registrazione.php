<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <h2>Registrazione</h2>
    <?php
        session_start();
        if (isset($_SESSION['errore_registrazione'])) {
            echo "<p style='color: red;'>" . $_SESSION['errore_registrazione'] . "</p>";
            unset($_SESSION['errore_login']);
        }
    ?>
    <form action="registrazione_script.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Registrati</button>
    </form>
    <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
</body>
</html>

