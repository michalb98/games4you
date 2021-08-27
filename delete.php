<?php

    session_start();
        
    if(!isset($_SESSION['login']) || $_SESSION['rank'] != "Administrator") {
        header('Location: strona-glowna');
    }
    
    if(!isset($_GET['id']) || !isset($_GET['what']))
        header('Location: admin-panel');

    require_once('./php/Database.php');

    $db = new Database();
    $pdo = $db->createPDO();

    switch($_GET['what']) {
        case 1:
            $db->deleteNotice($pdo, $_GET['id']);
            header('Location: zgloszenia');
        break;
        default:
            header('Location: admin-panel');
    }

?>