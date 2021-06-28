<?php

    class Database {

        protected $host = "localhost";
        protected $db_user = "root";
        protected $db_pass = "";
        protected $db_name = "sklep";

        function creatrPDO() {
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
    }

?>