<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Image.php');

    $db = new Database();
    $grid = new Grid();

    $pdo = $db->createPDO();
    $games = $db->getAllFromTable($pdo, 'game');

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

    <nav id="categories-nav">
        <?php

            $type = $db->getAllFromTable($pdo, 'type');
            $platform = $db->getAllFromTable($pdo, 'platform');
            $version = $db->getAllFromTable($pdo, 'version');
            $grid->drawNavCategories($type, 'Wybierz typ');
            $grid->drawNavCategories($platform, 'Wybierz platformę');
            $grid->drawNavCategories($version, 'Wybierz wersję');

        ?>
    </nav>
    <main>
        <div id="sort"></div>
        <?php
            $grid->drawGamesGrid($games);
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>