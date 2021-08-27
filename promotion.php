<?php

    session_start();
        
    if(!isset($_SESSION['login']) || $_SESSION['rank'] != "Administrator") {
        header('Location: strona-glowna');
    }

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Form.php');
    require_once('./php/Reply.php');
    require_once('./php/Admin.php');
    require_once('./php/Rank.php');

    $db = new Database();
    $grid = new Grid();
    $form = new Form();
    $admin = new Admin();
    $rank = new Rank();

    $pdo = $db->createPDO();

    if(isset($_POST['user-admin-form'])) {
        $rank->setUserAndRank($_POST['user-admin-form'], $_POST['rank-admin-form']);
        if($rank->validateRankForm()) {
            if($rank->addUserRank($db, $pdo)) {
                $_SESSION['rank-flag'] = $grid->showAlertWithFunction("Nadano rangę!", "Poprawnie nadano rangę użytkownikowi.", "success", "OK", "nadaj-range");
            } 
        } else {
            $_SESSION['rank-flag'] = $grid->showAlert("Nie nadano rangi!", "Proszę poprawić błędy.", "error", "OK");
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - nadaj rangę</title>
    <link rel="stylesheet" href="./css/admin-style.css">
    <link rel="stylesheet" href="./css/account-style.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
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
            $rank->drawRankForm($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <?php
        if(isset($_SESSION['rank-flag'])) {
            echo $_SESSION['rank-flag'];
            unset($_SESSION['rank-flag']);
        }
    ?>
</body>
</html>