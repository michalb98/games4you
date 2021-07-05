<?php

    require_once('./php/Image.php');

    class Database {

        protected $host = "localhost";
        protected $db_user = "root";
        protected $db_pass = "";
        protected $db_name = "sklep";

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

        function getAllFromTable($pdo, $table) {
            if ($pdo) {
                $sth = $pdo->prepare("SELECT * FROM `$table`;");
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

        function getFromTable($pdo, $select, $table) {
            if ($pdo) {
                $sth = $pdo->prepare("$select * FROM `$table`;");
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

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

        function addGameCover($title, $id) {
            $target_dir = "./img/temp/temp_cover.";
            $file = $_FILES["file-upload-input"]["name"];
            $target_file = $target_dir . pathinfo($file, PATHINFO_EXTENSION);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["file-upload-input"]["tmp_name"]);
            if($check == false) {
                //error
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                //error
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["file-upload-input"]["size"] > 500000) {
                //error
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                //error
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //error
                // if everything is ok, try to upload file
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