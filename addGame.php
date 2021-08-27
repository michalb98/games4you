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

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        if($form->validateForm()) {
            if($form->validateGameCover($db)){
                if($form->initiateAddGameToTable($pdo, $db))
                    $_SESSION['add-game-flag'] = $grid->showAlertWithFunction("Dodano grę!", "Pomyślnie dodano grę.", "success", "OK", 'dodaj-gre');
            }
            else {
                $form->keepFormValue();
                $_SESSION['add-game-flag'] = $grid->showAlert("Nie dodano gry!", "Proszę poprawić błędy.", "error", "OK");
            }
                
        }
        else {
            $form->keepFormValue();
            $_SESSION['add-game-flag'] = $grid->showAlert("Nie dodano gry!", "Proszę poprawić błędy.", "error", "OK");
        }   
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
    <main>
        <?php
            $admin->drawAddGameForm("Dodaj grę do sklepu", "Dodaj grę", 0);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
        if(isset($_SESSION['add-game-flag'])) {
            echo $_SESSION['add-game-flag'];
            unset($_SESSION['add-game-flag']);
        }
    ?>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script src="./js/autoNettoPrice.js"></script>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>