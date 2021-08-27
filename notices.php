<?php

    session_start();

    if(!isset($_SESSION['login']) || $_SESSION['rank'] != "Administrator") {
        header('Location: strona-glowna');
    }

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
    <main>
        <?php
            $admin->drawAllNotices($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>