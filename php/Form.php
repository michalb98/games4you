<?php

    class Form {
        //Dane z formularza Admin
        protected $title;
        protected $price_netto;
        protected $price_brutto;
        protected $short_desc;
        protected $desc;
        protected $quantity;
        protected $type;
        protected $version;
        protected $platform;

        //Dane z formularza Login
        protected $login;
        protected $password;

        //Dane z formularza rejestracji
        protected $login_register;
        protected $password_register;
        protected $email_register;

        //Pobieranie danych z formularza
        function getFormAdminData() {
            $this->title = filter_var($_POST['title-admin-form'], FILTER_SANITIZE_STRING);
            $this->price_netto = filter_var($_POST['netto-admin-form'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $this->price_brutto = filter_var($_POST['brutto-admin-form'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $this->short_desc = filter_var($_POST['short-desc-admin-form'], FILTER_SANITIZE_STRING);
            $this->desc = filter_var($_POST['desc-admin-form'], FILTER_SANITIZE_STRING);
            $this->quantity = filter_var($_POST['quantity-admin-form'], FILTER_SANITIZE_NUMBER_INT);
            $this->type = filter_var($_POST['type-admin-form'], FILTER_SANITIZE_NUMBER_INT);
            $this->version = filter_var($_POST['version-admin-form'], FILTER_SANITIZE_NUMBER_INT);
            $this->platform = filter_var($_POST['platform-admin-form'], FILTER_SANITIZE_NUMBER_INT);
        }

        //Pobieranie danych z formularza logowania 
        function getFormLoginData() {
            $this->login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $this->password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        }

        //Pobieranie danych z formularza rejestracji 
        function getFormRegisterData() {
            $this->login_register = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $this->password_register = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $this->email_register = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        }

        //Sprawdza poprawność formularza
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

        //Sprawdza poprawność formularza logowania
        function validateFormLogin($pdo, $db) {
            //flag
            $check = true;

            $query = $this->login.'" AND Password = "'.hash("sha512", $this->password);         
            $countIdUser = $db->countData($pdo, "ID_User", $query);

            if($this->login == '' || $this->password == '' || $countIdUser[0][0] < 1) {
                $_SESSION['login-form-error'] = 'Podano błędne dane logowania.';
                $check = false;
            }

            if($check)
                return true;
            else
                return false;
        }

        //Sprawdza poprawność formularza rejestrowania
        function validateFormRegister($pdo, $db) {
            //flag
            $check = true;

            $countIdUser = $db->countData($pdo, "ID_User", $this->login_register);
            $countEmail = $db->countData($pdo, "Email", $this->email_register);

            if($this->login_register == '' || strlen($this->login_register) < 5 || strlen($this->login_register) > 50) {
                $_SESSION['login-register-form-error'] = 'Popraw swój login! Login musi zawierać od 5 do 50 znaków.';
                $check = false;
            }

            if($this->password_register == '' || strlen($this->password_register) < 5 || strlen($this->password_register) > 100) {
                $_SESSION['password-register-form-error'] = 'Popraw swoje hasło! Hasło musi zawierać od 5 do 100 znaków.';
                $check = false;
            }

            if(filter_var($this->email_register, FILTER_VALIDATE_EMAIL) === false || $this->email_register == '') {
                $_SESSION['email-register-form-error'] = 'Popraw swój E-mail!';
                $check = false;
            }

            if($countIdUser[0][0] > 0) {
                $_SESSION['login-register-form-error'] = "Podany login już istnieje! Proszę wybrać inny.";
                $check = false;
            }

            if($countEmail[0][0] > 0) {
                $_SESSION['email-exist-register-form-error'] = 'Podany E-mail już istnieje w naszej bazie danych! Jeżeli nie pamiętasz hasła <a href="zapomnialem-hasla" title="Przypomnij hasło">przypomnij je</a> lub <a href="logowanie" title="Zaloguj się">Zaloguj się</a>.';
                $check = false;
            }

            if($check)
                return true;
            else
                return false;
        }

        //Zapamiętuje wartości formularza
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

        //Zapamiętuje wartości formularza logowania
        function keepFormLoginValue() {
            $_SESSION['login-value'] = $this->login;
        }

        //Zapamiętuje wartości formularza logowania
        function keepFormRegisterValue() {
            $_SESSION['login-value'] = $this->login_register;
            $_SESSION['email-value'] = $this->email_register;
        }

        //Funkcja wywołuję funkcję oraz podaje wymagane dane
        function initiateAddGameToTable($pdo, $db) {
            $db->addGameToTable($pdo, $this->title, $this->price_brutto, $this->price_netto, $this->short_desc, $this->desc, $this->quantity, $this->type, $this->version, $this->platform);
        }

        function initiateRegister($pdo, $db) {
            $password_register_hash = hash("sha512", $this->password_register);
            $db->register($pdo, $this->login_register, $password_register_hash, $this->email_register);
        }

        function login() {
            $_SESSION['login'] = $this->login;
        }

    }

?>