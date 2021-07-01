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