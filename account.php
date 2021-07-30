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
            
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>