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
    <title>Games4You - <?php $title = $grid->getTitlePage($_GET); echo $title[0].' '.$title[1].' '.$title[2].' '.$title[3].' '.$title[4].' '.$title[5]; ?></title>
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
            $grid->drawNavSearchAdvance($grid, $pdo, $db);  

        ?>
    </nav>
    <main>
        <?php
            $grid->drawSort($db, $pdo);
            $get = $grid->getInfo($_GET);
            $games = $db->getAllFromDatabase($pdo, 'SELECT DISTINCT ID_Game, Title, Price_brutto, Short_description FROM game, type, version, platform WHERE game.ID_Type=type.ID_Type AND game.ID_Version=version.ID_Version AND game.ID_Platform=platform.ID_Platform AND (type.Type LIKE "'.$get[0].'" AND version.Version LIKE "'.$get[1].'" AND platform.Platform LIKE "'.$get[2].'" AND Price_brutto BETWEEN '.$get[3].' AND '.$get[4].') ORDER BY '.$get[5].';');
            $grid->drawGamesResult($games);
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>