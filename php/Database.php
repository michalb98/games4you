<?php

    require_once('./php/Image.php');

    class Database {

        //Zmiene do bazy danych
        protected $host = "localhost";
        protected $db_user = "root";
        protected $db_pass = "";
        protected $db_name = "sklep";

        //Tworzy połączenie z bazą PDO, a następnie je zwraca
        function createPDO() {
            try {
                $pdo = new PDO("mysql:dbname=$this->db_name;charset=utf8;host=$this->host", "$this->db_user", "$this->db_pass");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }
            catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        //Pobiera wszystkie dane z wybranej tabeli oraz je zwraca
        function getAllFromTable($pdo, $table) {
            if ($pdo) {
                $sth = $pdo->prepare("SELECT * FROM `$table`;");
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

        //Pobiera wszystkie dane zawarte w zapytaniu do bazy, a następnie je zwraca
        function getAllFromDatabase($pdo, $query) {
            if ($pdo) {
                $sth = $pdo->prepare($query);
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

        //Wyszukuje danych wybranej gry, następnie je zwraca
        function getGameData($pdo, $id) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT Title, Price_brutto, Short_description, Description, type.Type, version.Version, platform.Platform FROM game, platform, version, type WHERE game.ID_Game = '.$id.' AND
                game.ID_Platform = platform.ID_Platform AND game.ID_Version = version.ID_Version AND game.ID_Type = type.ID_Type;');
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

        //Dodaje nową grę do bazy danych
        function addGameToTable($pdo, $title, $price_brutto, $price_netto, $short_desc, $desc, $quantity, $type, $version, $platform) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `game` VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $sth->execute([NULL, $title, $price_netto, $price_brutto, $short_desc, $desc, $quantity, $type, $version, $platform]);
                    $db = new Database();
                    $db->addGameCover($title, $type, 80);
                    return 'Dodano grę';
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca tytuł wybranej gry
        function getGameTitle($pdo, $id) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT title FROM game WHERE ID_Game='.$id.';');
                $sth->execute();
                $title = $sth->fetchAll(PDO::FETCH_NUM); 
                return $title[0][0];            
            } else {
                return 'Database error';
            }
        }

        //Dodaje okładkę gry w wybranym formacie do folderu img/temp
        function addGameCover($title, $id) {
            $target_dir = "./img/temp/temp_cover.";
            $file = $_FILES["file-upload-input"]["name"];
            $target_file = $target_dir . pathinfo($file, PATHINFO_EXTENSION);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            //Sprawdza, czy wgrane zdjęcie jest zdjęciem
            $check = getimagesize($_FILES["file-upload-input"]["tmp_name"]);
            if($check == false) {
                //error
                $uploadOk = 0;
            }

            //Sprawdza, czy istnieje już plik tymczasowy
            if (file_exists($target_file)) {
                //error
                $uploadOk = 0;
            }

            //Sprawdza wielkość obrazu
            if ($_FILES["file-upload-input"]["size"] > 500000) {
                //error
                $uploadOk = 0;
            }

            //Sprawdza format zdjęcia
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                //error
                $uploadOk = 0;
            }

            //Sprawdza flagę
            if ($uploadOk == 0) {
                //error
                //Jeżeli wszystko przebiegło poprawnie wgrywa zdjęcie do folderu
            } else {
                if (move_uploaded_file($_FILES["file-upload-input"]["tmp_name"], $target_file)) {
                    $image = new Image();
                    $image->convertImageToWebp('.\img\temp\temp_cover.'.$imageFileType, '.\img\covers\\'.$title.'_cover.webp', 80);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

?>