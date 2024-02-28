<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
        session_start();
        if (isset($_SESSION['errore_login'])) {
            echo "<p style='color: red;'>" . $_SESSION['errore_login'] . "</p>";
            unset($_SESSION['errore_login']);
        }
    ?>
    <form action="login_script.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Accedi</button>
    </form>
    <p>Non hai un account? <a href="registrazione.php">Registrati qui</a></p>
</body>
</html>
