<?php

    session_start();

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Image.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->createPDO();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title>Games4You - sklep z grami komputerowymi</title>
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>
    <main>
        <form method="POST" class="login-form">
            <label for="login" class="label-login-form">
                Login
            </label>
            <input type="text" name="login" id="login" class="text-login-form" placeholder="np. Adam123">
            <label for="mail" class="label-login-form">
                E-mail
            </label>
            <input type="email" name="mail" id="mail" class="text-login-form" placeholder="np. adam123@gmail.com">
            <label for="password" class="label-login-form">
                Hasło
            </label>
            <input type="password" name="password" id="password" class="text-login-form" placeholder="**********">
            <input type="submit" value="Zarejestruj się" class="submit-login-form">
            <p>Masz już konto? <a href="logowanie" title="Zaloguj się">Zaloguj się</a> już teraz!</p>
        </form> 
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>