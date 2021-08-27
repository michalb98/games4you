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

    if(isset($_POST['keys-admin-form'])) {
        $form->setKeys($_POST['keys-admin-form']);
        $form->setQuantity($_POST['quantity-admin-form']);
        $form->setTitle($_POST['title-admin-form']);

        if($form->validateKeys()) {
            $form->initiateAddKey($pdo, $db, $_POST['title-admin-form']);
            $_SESSION['add-keys-flag'] = $grid->showAlertWithFunction("Dodano klucze!", "Poprawnie dodano klucze do gry.", "success", "OK", "dodaj-klucze");
        } else {
            $form->keepFormKeyValue();
            $_SESSION['add-keys-flag'] = $grid->showAlert("Nie dodano kluczy!", "Proszę poprawić błędy.", "error", "OK");
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
        $admin->drawMainAdminHeader();
    ?>
    <main>
        <?php
            $admin->drawAddKeysForm($db, $pdo);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
        if(isset($_SESSION['add-keys-flag'])) {
            echo $_SESSION['add-keys-flag'];
            unset($_SESSION['add-keys-flag']);
        }
    ?>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>