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
    <title>Games4You - konto <?php echo $_SESSION['login']; ?></title>
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <link rel="stylesheet" href="./css/account.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>

    <nav id="categories-nav">
        <?php

            $type = $db->getAllFromTable($pdo, 'type');
            $platform = $db->getAllFromTable($pdo, 'platform');
            $version = $db->getAllFromTable($pdo, 'version');
            $grid->drawNavCategories($type, 'Wybierz typ', 'type');
            $grid->drawNavCategories($platform, 'Wybierz platformę', 'platform');
            $grid->drawNavCategories($version, 'Wybierz wersję', 'version');
            $grid->drawNavSearchAdvance($grid, $pdo, $db);  

        ?>
    </nav>
    <main>
        <nav id="nav-account">
            <a href="?account=ustawienia" title="" class="a-account">Ustawienia konta</a>
            <a href="?account=historia" title="" class="a-account">Historia zakupów</a>
            <a href="?account=ocena" title="" class="a-account">Oceny gier</a>
            <a href="?account=zwrot" title="" class="a-account">Zwrot gry</a>
            <a href="?account=kontakt" title="" class="a-account">Kontakt</a>
            <a href="?account=usunkonto" title="" class="a-account error">Usuń konto</a>
        </nav>
        <aside id="aside-account">
            <h1 class="account-text">Konto użytkownika: darx12311</h1>
            <form method="post">
                login
                <input type="text" name="login">
            </form>
        </aside>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>