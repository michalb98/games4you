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

    if(isset($_POST['keys-admin-form'])) {
        $form->setKeys($_POST['keys-admin-form']);
        $form->setQuantity($_POST['quantity-admin-form']);
        $form->setTitle($_POST['title-admin-form']);

        if($form->validateKeys()) {
            $form->initiateAddKey($pdo, $db, $_POST['title-admin-form']);
        } else {
            $form->keepFormKeyValue();
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - dodaj klucze</title>
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
            $admin->drawAddKeysForm($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>