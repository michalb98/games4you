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

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        if($form->validateForm()) {
            if($form->validateGameCover($db)){
                if($form->initiateAddGameToTable($pdo, $db))
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
            $admin->drawAddGameForm("Dodaj grę do sklepu", "Dodaj grę", 0);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script src="./js/autoNettoPrice.js"></script>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>