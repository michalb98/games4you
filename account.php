<?php

    session_start();

    require_once('./php/Database.php');
    require_once('./php/Grid.php');
    require_once('./php/Image.php');
    require_once('./php/Account.php');

    $db = new Database();
    $grid = new Grid();
    $account = new Account();

    $pdo = $db->createPDO();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="description" content="Sklep internetowy z grami komputerowymi">
    <title><?php $account->setAccountTitle(isset($_GET['account']) ? $_GET['account'] : '', $_SESSION['login']) ?></title>
    <link rel="stylesheet" href="./css/fontello.css">
    <link rel="stylesheet" href="./css/fontello-codes.css">
    <link rel="stylesheet" href="./css/account.css">
    <?php
        $grid->drawNecesseryHead();
    ?>
</head>
<body>

    <?php
        $grid->drawMainHeader();
    ?>

    <nav id="categories-nav">
        <?php

            $type = $db->getAllFromTable($pdo, 'type');
            $platform = $db->getAllFromTable($pdo, 'platform');
            $version = $db->getAllFromTable($pdo, 'version');
            $grid->drawNavCategories($type, 'Wybierz typ', 'type');
            $grid->drawNavCategories($platform, 'Wybierz platformę', 'platform');
            $grid->drawNavCategories($version, 'Wybierz wersję', 'version');
            $grid->drawNavSearchAdvance($grid, $pdo, $db);  

        ?>
    </nav>
    <main>
        <nav id="nav-account">
            <?php
                $account->drawAccountNav();
            ?>
        </nav>
        <aside id="aside-account">
            <?php
                $countries = $db->getAllFromTable($pdo, 'countries');
                $additionalData = $db->getUserAdditionalData($pdo, $_SESSION['login']);
                $mail = $db->getUserMail($pdo, $_SESSION['login']);
                
                $account->setData($mail, $additionalData[0][0], $additionalData[0][1], $additionalData[0][2], $additionalData[0][3], $additionalData[0][4], $additionalData[0][5], $additionalData[0][6], $additionalData[0][7], $_SESSION['login']);

                if(isset($_GET['account'])) {
                    switch ($_GET['account']) {
                        case "ustawienia":
                            $account->drawAccountSettings($countries);
                        break;
                        default:
                            $account->drawAccountSettings($countries);
                    }
                } else {
                    $account->drawAccountSettings($countries);
                }
            ?>
        </aside>
    </main>
    <?php
        $grid->drawFooter();
    ?>
</body>
</html>