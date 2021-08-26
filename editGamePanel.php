<?php

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Admin.php');
    require_once('./php/Form.php');

    $db = new Database();
    $grid = new Grid();
    $admin = new Admin();
    $form = new Form();

    $pdo = $db->createPDO();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - wybierz grę</title>
    <link rel="stylesheet" href="./css/admin-style.css">
    <link rel="stylesheet" href="./css/account-style.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>
    <?php
        $admin->drawMainAdminHeader();
    ?>
    <nav id="categories-nav">

    </nav>
    <main>
        <?php
            $admin->drawGameToEdit($db, $pdo, $grid);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>