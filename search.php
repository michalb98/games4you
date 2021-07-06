<?php

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
    <title>Games4You - <?php if(isset($_GET['type'])) echo $_GET['type']; else if(isset($_GET['version'])) echo $_GET['version']; else if(isset($_GET['platform'])) echo $_GET['platform']; else echo 'Rezultat'; ?></title>
    <link rel="stylesheet" href="./css/game-page.css">
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
            
            $grid->drawNavCategories($type, 'Wybierz typ', 'type');
            $grid->drawNavCategories($platform, 'Wybierz platformę', 'platform');
            $grid->drawNavCategories($version, 'Wybierz wersję', 'version');

        ?>
    </nav>
    <main>
        <?php
            $get = $grid->getInfo($_GET);
            $games = $db->getAllFromDatabase($pdo, 'SELECT DISTINCT ID_Game, Title, Price_brutto, Short_description FROM game, type, version, platform WHERE game.ID_Type=type.ID_Type AND game.ID_Version=version.ID_Version AND game.ID_Platform=platform.ID_Platform AND (type.Type LIKE "'.$get[0].'" AND version.Version LIKE "'.$get[1].'" AND platform.Platform LIKE "'.$get[2].'");');
            $grid->drawGamesResult($games);
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>