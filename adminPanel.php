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
    <title>Games4You - dodaj grę</title>
    <link rel="stylesheet" href="./css/admin-style.css">
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
            
        ?>
        <nav class="admin-menu-nav">
            <h1 class="h1-admin-panel">Panel Administratora Games4You</h1>
            <a class="admin-menu-nav-a" href="dodaj-gre" title="Dodaj nową grę">Dodaj grę</a>
            <a class="admin-menu-nav-a" href="dodaj-klucze" title="Dodaj nowe klucze do gry">Dodaj klucze</a>
            <a class="admin-menu-nav-a" href="wybierz-gre" title="Edytuj gry">Edytuj gry</a>
            <a class="admin-menu-nav-a" href="zgloszenia" title="Zgłoszenia użytkoników">Zobacz wysłane zgłoszenia</a>
        </nav>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>