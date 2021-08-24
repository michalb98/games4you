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
    $games = $db->getAllFromTable($pdo, 'game');
    $gameData = $db->getGameData($pdo, $_GET['id']);
    $_SESSION['game-cover'] = ".\img\covers\\".$gameData[0][0]."_cover.webp";

    $form->setFormEditGameValue($gameData[0][0], $gameData[0][8], $gameData[0][1], $gameData[0][2], $gameData[0][3], $gameData[0][7], $gameData[0][4], $gameData[0][5], $gameData[0][6]);
    $form->keepFormValue();

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        if($form->validateForm()) {
            if($form->validateGameCover($db)){
                if($form->initiateUpdateGame($pdo, $db, $_GET['id']))
                    header('Location: admin-panel');
            }
            else
                $form->keepFormValue();
        }
        else
            $form->keepFormValue();
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - panel administratora</title>
    <link rel="stylesheet" href="./css/admin-style.css">
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
        <?php
            $admin->drawAddGameForm("Edytuj grę ".$gameData[0][0], 1);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script src="./js/autoNettoPrice.js"></script>
</body>
</html>