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

        //Dodaje e-mail do tabeli additional_data
        function createAdditionalData($pdo, $mail) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `additional_data` VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $sth->execute([NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $mail]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca id tabeli additional_data gdzie e-mail jest zgodny z podanym w zmiennej $mail
        function getAdditionalDataId($pdo, $mail) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `ID_Additional_data` FROM `additional_data` WHERE `Email`="'.$mail.'";');
                    $sth->execute();
                    $id = $sth->fetchAll(PDO::FETCH_NUM);
                    return $id[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Dodaje nowego użytkownika do bazy danych
        function register($pdo, $login, $password, $mail, $db) {
            if ($pdo) {
                try {
                    $db->createAdditionalData($pdo, $mail);
                    $id = $db->getAdditionalDataId($pdo, $mail);
                    $sth = $pdo->prepare('INSERT INTO `user` VALUE (?, ?, ?, ?)');
                    $sth->execute([NULL, $login, $password, $id]);
                    $_SESSION['register'] = $login;
                    header('Location: logowanie');
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

        //Zwraca ilość użytkoników o loginie $data 
        function countData($pdo, $row, $data) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT COUNT('.$row.') FROM `user` WHERE Login = "'.$data.'"');
                $sth->execute();
                return $sth->fetchAll(PDO::FETCH_NUM);                
            } else {
                return 'Database error';
            }
        }

        //Zwraca ilość użytkoników o e-mail $mail
        function countEmail($pdo, $mail) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT COUNT(Email) FROM `additional_data` WHERE `Email` = "'.$mail.'"');
                $sth->execute();
                $countMail = $sth->fetchAll(PDO::FETCH_NUM); 
                return $countMail[0][0];               
            } else {
                return 'Database error';
            }
        }

        //Dodaje okładke gry do folderu \img\covers
        function addGameCover($title, $target_file, $imageFileType) {
            if (move_uploaded_file($_FILES["file-upload-input"]["tmp_name"], $target_file)) {
                $image = new Image();
                $image->convertImageToWebp('.\img\temp\temp_cover.'.$imageFileType, '.\img\covers\\'.$title.'_cover.webp', 80);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        //Zwraca e-mail użytkonika o loginie $login
        function getUserMail($pdo, $login){
            if ($pdo) {
                $sth = $pdo->prepare('SELECT Email FROM user, additional_data WHERE user.ID_Additional_data=additional_data.ID_Additional_data AND `Login` = "'.$login.'";');
                $sth->execute();
                $mail = $sth->fetchAll(PDO::FETCH_NUM); 
                return $mail[0][0];            
            } else {
                return 'Database error';
            }
        }

        //Zwraca id użytkonika o loginie $login
        function getUserId($pdo, $login){
            if ($pdo) {
                $sth = $pdo->prepare('SELECT ID_User FROM user WHERE `Login` = "'.$login.'";');
                $sth->execute();
                $idUser = $sth->fetchAll(PDO::FETCH_NUM); 
                return $idUser[0][0];            
            } else {
                return 'Database error';
            }
        }

        //Zwraca imię, nazwisko, kraj, miasto, kod pocztowy, ulicę, numer ulicy, numer mieszkania oraz e-mail użytkonika o loginie $login
        function getUserAdditionalData($pdo, $login) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT Name, Surname, Country, City, Postal_code, Street, Street_number, House_number, Email FROM additional_data, countries, user WHERE additional_data.ID_Country=countries.ID_Country AND user.ID_Additional_data = additional_data.ID_Additional_data AND `Login` = "'.$login.'";');
                $sth->execute(); 
                return $sth->fetchAll(PDO::FETCH_NUM);            
            } else {
                return 'Database error';
            }
        }

        //Zwraca hash hasła użytkonika o loginie $login
        function getUserPasswordHash($pdo, $login) {
            if ($pdo) {
                $sth = $pdo->prepare('SELECT `Password` FROM user WHERE `Login` = "'.$login.'";');
                $sth->execute(); 
                $password = $sth->fetchAll(PDO::FETCH_NUM); 
                return $password[0][0];           
            } else {
                return 'Database error';
            }
        }

        //Zmienia hasło użytkonika o loginie $login
        function updateUserSettings($pdo, $login, $password) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `user` SET `Password`=? WHERE `Login` = "'.$login.'"');
                    $sth->execute([$password]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca id kraju o nazwie $country
        function getIdCountry($pdo, $country) {
            if ($pdo && $country != "Wybierz swój kraj...") {
                $sth = $pdo->prepare('SELECT `ID_Country` FROM countries WHERE `Country` = "'.$country.'";');
                $sth->execute(); 
                $idCountry = $sth->fetchAll(PDO::FETCH_NUM); 
                return $idCountry[0][0];           
            } else {
                return 'Database error';
            }
        }

        //Zmienia imię, nazwisko, kraj, miasto, kod pocztowy, ulicę, numer ulicy, numer mieszkania oraz e-mail użytkonika o loginie $login
        function updateUserAdditionalSettings($pdo, $login, $idCountry, $name, $surname, $postalCode, $city, $street, $streetNumber, $houseNumber, $mail) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `additional_data`, `user` SET `ID_Country`=?, `Name`=?, `Surname`=?, `Postal_code`=?, `City`=?, `Street`=?, `Street_number`=?, `House_number`=?, `Email`=? WHERE user.ID_Additional_data=additional_data.ID_Additional_data AND `Login` = "'.$login.'"');
                    $sth->execute([$idCountry, $name, $surname, $postalCode, $city, $street, $streetNumber, $houseNumber, $mail]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca numery zamówieć użytkonika o loginie $login
        function getOrdersNumbers($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT DISTINCT order_number.Order_number FROM order_number, orders, `transaction`, user WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND `transaction`.ID_User=user.ID_User AND orders.ID_Order_number=order_number.ID_Order_number AND user.Login = "'.$login.'" ORDER BY `Order_number` DESC;');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca wszystkie id gry, tytuł gry, cenę brutto gry, ilość, datę zamównienia oraz metodę płatności dla użytkonika o loginie $login oraz numerowi zamówienia $orderNumber
        function getOrders($pdo, $login, $orderNumber) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT game.ID_Game, game.Title, `transaction`.`Price_brutto`, order_number.Order_number, `transaction`.Quantity, `transaction`.`Data`, payment_method.Payment_method FROM game, user, additional_data, `transaction`, orders, payment_method, order_number WHERE `transaction`.ID_Payment_method=payment_method.ID_Payment_method AND orders.ID_Order_number=order_number.ID_Order_number AND orders.ID_Order_number=order_number.ID_Order_number AND orders.ID_Transaction=`transaction`.ID_Transaction AND `transaction`.ID_Game=game.ID_Game AND `transaction`.ID_User=user.ID_User AND user.ID_Additional_data=additional_data.ID_Additional_data AND order_number.Order_number = "'.$orderNumber.'" AND user.Login = "'.$login.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca wartosć zamówienie o numerze $orderNumber
        function getOrderValue($pdo, $orderNumber) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT SUM(`transaction`.Price_brutto) FROM `transaction`, orders, order_number WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND orders.ID_Order_number=order_number.ID_Order_number AND order_number.Order_number = "'.$orderNumber.'";');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca ilość produktów z zamówienia o numerze $orderNumber
        function getOrderGameValue($pdo, $orderNumber) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT SUM(`transaction`.Quantity) FROM `transaction`, orders, order_number WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND orders.ID_Order_number=order_number.ID_Order_number AND order_number.Order_number = "'.$orderNumber.'";');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwaraca gry które może ocenić użytkonik o loginie $login
        //Użytkonik może ocenić tylko te gry które kupił oraz wyświetlił klucz produktu
        //Grę można ocenić tylko raz niezależnie od ilość kupionych kluczy
        function getGamesToRating($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT DISTINCT game.ID_Game, game.Title FROM `transaction`, game, user WHERE transaction.ID_Game=game.ID_Game AND transaction.ID_User=user.ID_User AND user.Login = "'.$login.'" AND `transaction`.ID_Return IS NULL AND `transaction`.Show_key = 1;');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca ocenę gry o id $idGame którą ocenił użytkonik o loginie $login
        function checkGameToRating($pdo, $login, $idGame) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT Rating FROM `game_rating`, user, game WHERE game_rating.ID_User=user.ID_User AND game_rating.ID_Game=game.ID_Game AND user.Login = "'.$login.'" AND game.ID_Game = "'.$idGame.'";');
                    $sth->execute(); 
                    $rating = $sth->fetchAll(PDO::FETCH_NUM);
                    if(empty($rating)) {
                        return false;
                    } else {
                        return $rating[0][0];
                    }
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Dodaje wpis do tabeli game_rating 
        //Jest to ocena gry przez użytkownika 
        function insertGameRating($pdo, $idGame, $idUser, $rating) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `game_rating` VALUE (?, ?, ?, ?)');
                    $sth->execute([NULL, $idGame, $idUser, $rating]);
                    return 'Oceniono grę';
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca średnią ocen zaokrągloną do 2 miejsca po przecinku gry o id $idGame
        function getGameRating($pdo, $idGame) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT ROUND(AVG(game_rating.Rating),2) FROM `game_rating` WHERE game_rating.ID_Game= '.$idGame.';');
                    $sth->execute(); 
                    $rating = $sth->fetchAll(PDO::FETCH_NUM);
                    if(empty($rating)) {
                        return false;
                    } else {
                        return $rating[0][0];
                    }
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Sprawdza jakie gry użytkwonik może oddać
        //Użytkwonik może oddać tylko te produkty u których nie wyświeltił klucza
        function checkGamesToReturn($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT game.ID_Game, game.Title, order_number.Order_number, `transaction`.ID_transaction FROM `transaction`, orders, user, game, order_number WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND orders.ID_Order_number=order_number.ID_Order_number AND `transaction`.ID_User=user.ID_User AND `transaction`.ID_Game=game.ID_Game AND `transaction`.ID_Return IS NULL AND `transaction`.Show_key=0 AND user.Login="'.$login.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca, czy klucz został wyświetlony klucz gry o id $gameId w transakcji o id $idTransaction
        function checkGameToReturn($pdo, $gameId, $idTransaction) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `transaction`.Show_key FROM `transaction`, orders, order_number WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND orders.ID_Order_number=order_number.ID_Order_number AND `transaction`.ID_Game='.$gameId.' AND `transaction`.ID_Return IS NULL AND `transaction`.ID_Transaction = "'.$idTransaction.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca probelmy z tabeli Issue
        function getIssue($pdo) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT Issue FROM `issue`;');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca id gry, tytuł gry, numer zamówienia oraz id transakcji użytkonika o loginie $login
        //Zwraca kupione gry, które nie zostały oddane
        function boughtGames($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT game.ID_Game, game.Title, order_number.Order_number, `transaction`.ID_transaction FROM `transaction`, orders, user, game, order_number WHERE orders.ID_Transaction=`transaction`.ID_Transaction AND orders.ID_Order_number=order_number.ID_Order_number AND `transaction`.ID_User=user.ID_User AND `transaction`.ID_Game=game.ID_Game AND `transaction`.ID_Return IS NULL AND user.Login="'.$login.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca klucz gry o id $idGame
        function getGameKey($pdo, $idGame) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT Game_key.Game_key FROM `game_key` WHERE Game_key.ID_Game = "'.$idGame.'" AND Game_key.Key_bought = 0;');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zmienia wartość Show_key na 1
        //Oznacz to, że użytkownik wyświetlił klucz produktu
        function updateTransactionShowKey($pdo, $idGame, $idTransaction) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `transaction` SET `Show_key`=? WHERE `transaction`.ID_Game = '.$idGame.' AND `ID_Transaction` = '.$idTransaction.';');
                    $sth->execute([1]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Dodaje id zwrotu oraz id kodu rabatowego do tabeli transaction
        //Oznacza to, że użytkwonik oddał produkt oraz otrzymał kod rabatowy 
        function updateTransactionReturn($pdo, $idTransaction, $idReturn, $idDiscountCode) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `transaction` SET `ID_Return`=?, `ID_Discount_code`=? WHERE `ID_Transaction` = '.$idTransaction.';');
                    $sth->execute([$idReturn, $idDiscountCode]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca klucz gry o id $idGame, który został zakupiony podczas transakcji o id $idTransaction
        function showGameKey($pdo, $idTransaction, $idGame) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT game_key.Game_key FROM game_key, `transaction` WHERE `transaction`.ID_Game_key=game_key.ID_Game_key AND `transaction`.ID_Transaction = '.$idTransaction.' AND Game_key.ID_Game = '.$idGame.';');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca wartość brutto transakcji o id $idTransaction)
        function getPriceBruttoFromTransaction($pdo, $idTransaction) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `transaction`.`Price_brutto` FROM `transaction` WHERE `transaction`.ID_Transaction = '.$idTransaction.';');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zapisuje do bazy wygenerowny kod rabatowy, ważność kodu oraz wartość kodu
        function insertIntoDiscountCode($pdo, $discountCode, $validateFrom, $validateTo, $value) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `discount_code` VALUE (?, ?, ?, ?, ?)');
                    $sth->execute([NULL, $discountCode, $validateFrom, $validateTo, $value]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca id kodu rabatowego 
        function getIdDiscountCode($pdo, $discountCode) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `ID_Discount_code` FROM `discount_code` WHERE Code = "'.$discountCode.'";');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zapisuje do bazy zwroty 
        //Oznacz to zwrot produktu
        function insertIntoReturns($pdo, $idTransaction, $idDiscountCode) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `returns` VALUE (?, ?, ?)');
                    $sth->execute([NULL, $idTransaction, $idDiscountCode]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca id zwrotu
        function getIdReturn($pdo, $idTransaction, $idDiscountCode) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `ID_Return` FROM `returns` WHERE ID_Transaction = '.$idTransaction.' AND ID_Discount_code = '.$idDiscountCode.';');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca kod rabatowy, ważność oraz jego wartość
        function getDiscountCode($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT discount_code.Code, Valid_from, Valid_to, `Value` FROM `discount_code`, `transaction`, `user` WHERE `transaction`.ID_User=user.ID_User AND `transaction`.ID_Discount_code=discount_code.ID_Discount_code AND user.Login = "'.$login.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        //Zwraca gry zwrócone przez użytkownika o loginie $login
        function getReturnedGames($pdo, $login) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT game.ID_Game, game.Title, discount_code.Code FROM `returns`, game, discount_code, `transaction`, `user` WHERE transaction.ID_Game=game.ID_Game AND transaction.ID_Discount_code=discount_code.ID_Discount_code AND transaction.ID_Return=returns.ID_Return AND transaction.ID_User=user.ID_User AND user.Login = "'.$login.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function deleteAdditionalData($pdo, $idAdditionalData) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('DELETE FROM `additional_data` WHERE ID_Additional_data=?');
                    $sth->execute([$idAdditionalData]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function updateTransactionDelete($pdo, $idUser) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `transaction` SET `ID_User`=? WHERE `ID_User` = '.$idUser.';');
                    $sth->execute([0]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function updateGameRatingDelete($pdo, $idUser) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('UPDATE `game_rating` SET `ID_User`=? WHERE `ID_User` = '.$idUser.';');
                    $sth->execute([0]);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function deleteUser($pdo, $idUser) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('DELETE FROM `user` WHERE ID_User=?');
                    $sth->execute([$idUser]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function checkDiscountCode($pdo, $discountCode) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT discount_code.Code, discount_code.Valid_from, discount_code.Valid_to, discount_code.Value FROM `discount_code` WHERE discount_code.Code = "'.$discountCode.'";');
                    $sth->execute(); 
                    return $sth->fetchAll(PDO::FETCH_NUM);
                } catch(Exception $e) {
                    return false;
                }
            }
        }

        function getLastOrderNumberID($pdo){
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT order_number.ID_Order_number FROM `order_number` ORDER BY order_number.ID_Order_number DESC LIMIT 1;');
                    $sth->execute(); 
                    $id = $sth->fetchAll(PDO::FETCH_NUM);
                    return $id[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function insertIntoOrderNumber($pdo, $orderNumber) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `order_number` VALUE (?, ?)');
                    $sth->execute([NULL, $orderNumber]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function insertIntoTransaction($pdo, $idGame, $idGameKey, $idUser, $idPayment, $priceNetto, $priceBrutto, $quantity, $data) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `transaction` VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $sth->execute([NULL, $idGame, $idGameKey, $idUser, $idPayment, NULL, NULL, $priceNetto, $priceBrutto, $quantity, $data, 0]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function getPaymentMethodId($pdo, $paymentMethod) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT payment_method.ID_Payment_method FROM `payment_method` WHERE Payment_method = "'.$paymentMethod.'";');
                    $sth->execute(); 
                    $sum = $sth->fetchAll(PDO::FETCH_NUM);
                    return $sum[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function insertIntoOrders($pdo, $idTransaction, $idOrderNumber) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('INSERT INTO `orders` VALUE (?, ?, ?)');
                    $sth->execute([NULL, $idTransaction, $idOrderNumber]);
                    return true;
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function getGameKeyId($pdo, $idGame) {
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT Game_key.ID_Game_key FROM `game_key` WHERE Game_key.ID_Game = '.$idGame.' AND Game_key.Key_bought = 0;');
                    $sth->execute(); 
                    $id = $sth->fetchAll(PDO::FETCH_NUM);
                    return $id[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        function getTransactionId($pdo, $idUser){
            if ($pdo) {
                try {
                    $sth = $pdo->prepare('SELECT `transaction`.ID_Transaction FROM `transaction` WHERE `transaction`.`ID_User` = '.$idUser.' ORDER BY `transaction`.`ID_Transaction` DESC LIMIT 1;');
                    $sth->execute(); 
                    $id = $sth->fetchAll(PDO::FETCH_NUM);
                    return $id[0][0];
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }

    }

?>