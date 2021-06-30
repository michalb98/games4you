<?php

    require_once('./php/Database.php');

    class Form {
        protected $title;
        protected $price_netto;
        protected $price_brutto;
        protected $short_desc;
        protected $desc;
        protected $quantity;
        protected $type;
        protected $version;
        protected $platform;

        function getFormAdminData() {
            $this->title = $_POST['title-admin-form'];
            $this->price_netto = $_POST['brutto-admin-form'];
            $this->price_brutto = $_POST['netto-admin-form'];
            $this->short_desc = $_POST['short-desc-admin-form'];
            $this->desc = $_POST['desc-admin-form'];
            $this->quantity = $_POST['quantity-admin-form'];
            $this->type = $_POST['type-admin-form'];
            $this->version = $_POST['version-admin-form'];
            $this->platform = $_POST['platform-admin-form'];
        }

        function initiateAddGameToTable($pdo) {
            $db = new Database();
            $db->addGameToTable($pdo, $this->title, $this->price_brutto, $this->price_netto, $this->short_desc, $this->desc, $this->quantity, $this->type, $this->version, $this->platform);
        }

    }

?>