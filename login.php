<?php

    session_start();

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Form.php');

    $db = new Database();
    $grid = new Grid();
    $form = new Form();

    $pdo = $db->createPDO();

    if(isset($_POST['login'])) {
        $form->getFormLoginData();
        if($form->validateFormLogin($pdo, $db))
            $form->login();
        else
            $form->keepFormLoginValue();
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
            if(isset($_SESSION['register'])) {
                echo 'Witaj '.$_SESSION['register'].'!';
                unset($_SESSION['register']);
            }
        
            $grid->drawLoginForm();
        ?>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>