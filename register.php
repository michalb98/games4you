<?php

    session_start();

    if(isset($_SESSION['login']))
        header('Location: strona-glowna');

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Form.php');

    $db = new Database();
    $grid = new Grid();
    $form = new Form();

    $pdo = $db->createPDO();

    if(isset($_POST['login'])) {
        $form->getFormRegisterData();
        if($form->validateFormRegister($pdo, $db))
            $form->initiateRegister($pdo, $db);
        else
            $form->keepFormRegisterValue($pdo, $db);
    }

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
    <main>
        <?php 
            $grid->drawRegisterForm();
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>