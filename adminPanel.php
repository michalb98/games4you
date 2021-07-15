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

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        if($form->validateForm()) {
            if($form->validateGameCover($db)){
                $form->initiateAddGameToTable($pdo, $db);
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
            $admin->drawAddGameForm();
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