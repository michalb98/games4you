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
        protected $keys;

        //Dane z formularza Login
        protected $login;
        protected $password;

        //Dane z formularza rejestracji
        protected $login_register;
        protected $password_register;
        protected $email_register;

        function setFormEditGameValue($title, $price_netto, $price_brutto, $short_desc, $desc, $quantity, $type, $version, $platform) {
            $this->title = filter_var($title, FILTER_SANITIZE_STRING);
            $this->price_netto = filter_var($price_netto, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $this->price_brutto = filter_var($price_brutto, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $this->short_desc = filter_var($short_desc, FILTER_SANITIZE_STRING);
            $this->desc = filter_var($desc, FILTER_SANITIZE_STRING);
            $this->quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);
            $this->type = filter_var($type, FILTER_SANITIZE_STRING);
            $this->version = filter_var($version, FILTER_SANITIZE_STRING);
            $this->platform = filter_var($platform, FILTER_SANITIZE_STRING);
        }

        //Pobieranie danych z formularza oraz sanityzacjia
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
            $this->keys = filter_var($_POST['keys-admin-form'], FILTER_SANITIZE_STRING);
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

        //Sprawdza poprawność formularza dodawania gry
        function validateForm() {
            //flaga
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
            if($this->keys == '' || strlen($this->keys) < 15) {
                $_SESSION['keys-form-error'] = 'Proszę podać przynajmniej jeden klucz produktu!';
                $check = false;
            }

            if($check)
                return true;
            else
                return false;
        }

        //Sprawdza poprawność okładki 
        function validateGameCover($db) {
            $target_dir = "./img/temp/temp_cover.";
            $file = $_FILES["file-upload-input"]["name"];
            $target_file = $target_dir . pathinfo($file, PATHINFO_EXTENSION);
            $uploadOk = true;
            $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            //Sprawdza, czy wgrane zdjęcie jest zdjęciem
            $check = getimagesize($_FILES["file-upload-input"]["tmp_name"]);
            if($check == false) {
                $_SESSION['file-upload-error'] = "Nierozpoznano formatu zdjęcia!";
                $uploadOk = false;
            }

            //Sprawdza, czy istnieje już plik tymczasowy
            if (file_exists($target_file)) {
                $_SESSION['file-upload-error'] = "Błąd przetwarzaina spróbuj ponownoie!";
                unlink($target_file);
                $uploadOk = false;
            }

            //Sprawdza wielkość obrazu
            if ($_FILES["file-upload-input"]["size"] > 500000) {
                $_SESSION['file-upload-error'] = "Obraz jest zbyt duży!";
                $uploadOk = false;
            }

            //Sprawdza format zdjęcia
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $_SESSION['file-upload-error'] = "Nierozpoznano formatu zdjęcia!";
                $uploadOk = false;
            }

            //Sprawdza flagę
            if($uploadOk) {
                //Jeżeli wszystko przebiegło poprawnie wgrywa zdjęcie do folderu
                $db->addGameCover($this->title, $target_file, $imageFileType);
                return true;
            } else {
                return false;
            }
        }

        //Sprawdza poprawność formularza logowania
        function validateFormLogin($pdo, $db) {
            //flaga
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
            //flaga
            $check = true;

            $countIdUser = $db->countData($pdo, "ID_User", $this->login_register);
            $countEmail = $db->countEmail($pdo, $this->email_register);

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

            if($countEmail > 0) {
                $_SESSION['email-exist-register-form-error'] = 'Podany E-mail już istnieje w naszej bazie danych! Jeżeli nie pamiętasz hasła <a href="zapomnialem-hasla" title="Przypomnij hasło">przypomnij je</a> lub <a href="logowanie" title="Zaloguj się">Zaloguj się</a>.';
                $check = false;
            }

            if($check)
                return true;
            else
                return false;
        }

        //Zapamiętuje wartości formularza dodawania gry
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
            $_SESSION['keys-value'] = $this->keys;
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
            try {
                $db->addGameToTable($pdo, $this->title, $this->price_brutto, $this->price_netto, $this->short_desc, $this->desc, $this->quantity, $this->type, $this->version, $this->platform); 
                $idGame = $db->getGameId($pdo, $this->title);
                $key = explode(",", $this->keys);
                for($i = 0; $i < sizeof($key); $i++) {
                    $db->insertIntoGameKey($pdo, $idGame, $key[$i]);
                }
                return true;
            } catch (Exception $e) {
                return false;
            }           
        }

        function initiateUpdateGame($pdo, $db, $idGame) {
            $db->updateGame($pdo, $idGame, $this->title, $this->price_netto, $this->price_brutto, $this->short_desc, $this->desc, $this->quantity, $this->type, $this->version, $this->platform);
        }

        function initiateRegister($pdo, $db) {
            $password_register_hash = hash("sha512", $this->password_register);
            $db->register($pdo, $this->login_register, $password_register_hash, $this->email_register, $db);
        }

        function login() {
            $_SESSION['login'] = $this->login;
            header('Location: strona-glowna');
        }

    }

?>