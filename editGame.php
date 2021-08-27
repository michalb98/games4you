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

    $gameData = $db->getGameData($pdo, $_GET['id']);

    $_SESSION['game-cover'] = ".\img\covers\\".$gameData[0][0]."_cover.webp";

    $form->setFormEditGameValue($gameData[0][0], $gameData[0][8], $gameData[0][1], $gameData[0][2], $gameData[0][3], $gameData[0][7], $gameData[0][4], $gameData[0][5], $gameData[0][6]);
    $form->keepFormValue();

    if(isset($_POST['title-admin-form'])) {
        $form->getFormAdminData();
        if($form->validateFormEdit()) {
            if(isset($_FILES['file-upload-input']) && empty($_FILES['file-upload-input'])) {
                if($form->validateGameCover($db)){
                    if($form->initiateUpdateGame($pdo, $db, $_GET['id'], $gameData[0][0]))
                        $_SESSION['edit-game-flag'] = $grid->showAlertWithFunction("Edytowano grę!", "Poprawnie edytowano grę.", "success", "OK", 'edytuj?id='.$_GET["id"].'');
                }
                else {
                    $form->keepFormValue();
                    $_SESSION['edit-game-flag'] = $grid->showAlert("Nie edytowano gry!", "Proszę poprawić błędy.", "error", "OK");
                }
                    
            } else {
                if($form->initiateUpdateGame($pdo, $db, $_GET['id'], $gameData[0][0]))
                    $_SESSION['edit-game-flag'] = $grid->showAlertWithFunction("Edytowano grę!", "Poprawnie edytowano grę.", "success", "OK", 'edytuj?id='.$_GET["id"].'');
                else {
                    $form->keepFormValue();
                    $_SESSION['edit-game-flag'] = $grid->showAlert("Nie edytowano gry!", "Proszę poprawić błędy.", "error", "OK");
                }
                    
            }
        }
        else {
            $form->keepFormValue();
            $_SESSION['edit-game-flag'] = $grid->showAlert("Nie edytowano gry!", "Proszę poprawić błędy.", "error", "OK");
        }  
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Games4You - edytuj grę <?php echo $gameData[0][0];?></title>
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
            $admin->drawAddGameForm("Edytuj grę: ".$gameData[0][0], "Edytuj grę", 1);
        ?>
        
    </main>
    <?php
        $grid->drawFooter();
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <?php
        if(isset($_SESSION['edit-game-flag'])) {
            echo $_SESSION['edit-game-flag'];
            unset($_SESSION['edit-game-flag']);
        }
    ?>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="./js/previewCover.js"></script>
    <script src="./js/autoNettoPrice.js"></script>
    <script src="./js/autoQuantity.js"></script>
</body>
</html>