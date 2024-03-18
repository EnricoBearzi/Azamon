<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="gstyle.css">
  <script src="animation.js"></script>
</head>
<body>
    <h1 class="title" id="title">Azamon</h1>
    <div class="login-box" id="login-box">
        <div class="hidden login-form-wrapper" id="login-form-wrapper">
            <h2>Login</h2>
            <hr>
            <form action="login_script.php" id="login-form" method="POST">
                <input type="text" placeholder="e-mail" name="email">
                <input type="text" placeholder="password" name="password">
                <button class="login-btn" type="submit">Login</button>
            </form>
            
            <hr>
            <p>Don't have an account?</p>
            <button class="signup-btn" onclick="triggerRight()"> Sign Up</button>
            <?php
                session_start();
                if (isset($_SESSION['errore_login'])) {
                    echo "<p style='color: red;'>" . $_SESSION['errore_login'] . "</p>";
                    unset($_SESSION['errore_login']);
                }
            ?>
        </div>

        <div class="hidden register-form-wrapper" id="register-form-wrapper">
            <h2>Sign Up</h2>
            <hr>
            <form action="registrazione_script.php" id="register-form" method="POST">
                <div class="reg-data">
                    <input type="text" placeholder="name" name="nome">
                    <input type="text" placeholder="surname" name="cognome">
                </div>
                <input type="text" placeholder="e-mail" name="email">
                <input type="text" placeholder="password" name="password">
                <button class="signup-btn" type="submit">Sign Up</button>
            </form>
            <hr>
            <p>Have an account?</p>
            <button class="login-btn" onclick="triggerLeft()">Login</button>
            <?php
                session_start();
                if (isset($_SESSION['errore_registrazione'])) {
                    echo "<p style='color: red;'>" . $_SESSION['errore_registrazione'] . "</p>";
                    unset($_SESSION['errore_login']);
                }
            ?>
        </div>

        <button class="login-btn" id="login-start-btn" onclick="loginAnimation()">Login</button>
        <button class="signup-btn" id="signup-start-btn" onclick="signUpAnimation()">Sign Up</button>
    </div>
</body>
</html>
