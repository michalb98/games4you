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
            $this->price_netto = $_POST['netto-admin-form'];
            $this->price_brutto = $_POST['brutto-admin-form'];
            $this->short_desc = $_POST['short-desc-admin-form'];
            $this->desc = $_POST['desc-admin-form'];
            $this->quantity = $_POST['quantity-admin-form'];
            $this->type = $_POST['type-admin-form'];
            $this->version = $_POST['version-admin-form'];
            $this->platform = $_POST['platform-admin-form'];
        }

        function validateForm() {
            //flag
            $check = true;

            if($this->title == '' || strlen($this->title) < 3 || strlen($this->title) > 50) {
                $_SESSION['title-form-error'] = 'Podany tytuł jest niepoprawny! Poprawna długość to od 3 do 50 znaków.';
                $check = false;
            }
            if($this->price_netto == '' || $this->price_netto < 0.01 || $this->price_netto > 999.99) {
                $_SESSION['price-netto-form-error'] = 'Podana cena netto jest niepoprawna! Zakres cen to od 0,01 do 999,99 zł.';
                $check = false;
            }
            if($this->price_brutto == '' || $this->price_brutto < 0.01 || $this->price_brutto > 999.99) {
                $_SESSION['price-brutto-form-error'] = 'Podana cena brutto jest niepoprawna! Zakres cen to od 0,01 do 999,99 zł.';
                $check = false;
            }
            if($this->short_desc == '' || strlen($this->short_desc) < 50 || strlen($this->short_desc) > 250) {
                $_SESSION['short-desc-form-error'] = 'Podany krótki opis jest niepoprawny! Poprawna długość to od 50 do 250 znaków.';
                $check = false;
            }
            if($this->desc == '' || strlen($this->desc) < 50 || strlen($this->desc) > 5000) {
                $_SESSION['desc-form-error'] = 'Podany opis jest niepoprawny! Poprawna długość to od 50 do 5000 znaków.';
                $check = false;
            }
            if($this->quantity == '' || $this->quantity < 1 || $this->quantity > 999) {
                $_SESSION['quantity-form-error'] = 'Podana ilość kluczy jest niepoprawna! Zakres kluczy to od 1 do 999.';
                $check = false;
            }
            if($this->type == 'default') {
                $_SESSION['type-form-error'] = 'Proszę wybrać poprawny typ!';  
                $check = false;
            }
            if($this->version == 'default') {
                $_SESSION['version-form-error'] = 'Proszę wybrać poprawną wersję!'; 
                $check = false;
            }
            if($this->platform == 'default') {
                $_SESSION['platform-form-error'] = 'Proszę wybrać poprawną platformę!';
                $check = false;
            } 

            if($check)
                return true;
            else
                return false;
        }

        function keepFormValue() {
            $_SESSION['title-value'] = $this->title;
            $_SESSION['price-netto-value'] = $this->price_netto;
            $_SESSION['price-brutto-value'] = $this->price_brutto;
            $_SESSION['short-desc-value'] = $this->short_desc;
            $_SESSION['desc-value'] = $this->desc;
            $_SESSION['quantity-value'] = $this->quantity;
            $_SESSION['type-value'] = $this->type;
            $_SESSION['version-value'] = $this->version;
            $_SESSION['platform-value'] = $this->platform;
        }

        function initiateAddGameToTable($pdo) {
            $db = new Database();
            $db->addGameToTable($pdo, $this->title, $this->price_brutto, $this->price_netto, $this->short_desc, $this->desc, $this->quantity, $this->type, $this->version, $this->platform);
        }

    }

?>