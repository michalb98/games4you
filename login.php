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
            <label for="password" class="label-login-form">
                Hasło
            </label>
            <input type="password" name="password" id="password" class="text-login-form" placeholder="**********">
            <input type="submit" value="Zaloguj się" class="submit-login-form">
            <p>Nie masz konta? <a href="rejestracja" title="Zarejestruj się">Zarejestruj się</a> już teraz!</p>
            <p>Nie pamiętasz hasła? <a href="zapomnialem-hasla" title="Przypomnij hasło">Przypomnij hasło</a> i uzyskaj dostęp do swojego konta!</p>
        </form> 
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>